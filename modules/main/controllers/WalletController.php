<?php

namespace app\modules\main\controllers;

use app\behaviors\AjaxBehavior;
use app\components\core\Controller;
use app\models\GameMatch;
use app\models\Prediction;
use app\models\PredictionCounter;
use app\models\TaskStatus;
use app\models\Wallet;
use app\models\WalletTask;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class WalletController extends Controller
{
    public function behaviors()
    {
        return [
            'ajax' => [
                'class' => AjaxBehavior::class
            ]
        ];
    }

    public function actionTask($id)
    {
        if (Yii::$app->user->isGuest) {
            throw new ForbiddenHttpException();
        }

        $model = WalletTask::findOne($id);

        if (!$model) {
            throw new NotFoundHttpException();
        }

        $status = TaskStatus::find()->where([
            'task_id' => $model->id,
            'user_id' => Yii::$app->user->id
        ])->one();

        if ($status) {
            throw new NotFoundHttpException();
        }

        $status = new TaskStatus();
        $status->task_id = $model->id;
        $status->user_id = Yii::$app->user->id;
        $status->save();

        /** @var Wallet $wallet */
        $wallet = Yii::$app->user->identity->wallet;
        $currentCoins = $wallet->coins;
        $currentCoins += $model->cost;
        $wallet->coins = $currentCoins;
        $wallet->save();

        return [
            'coins' => $currentCoins
        ];
    }

    public function actionPredict()
    {
        $match_id = Yii::$app->request->post('match_id');
        $selected_team = Yii::$app->request->post('team_id');

        $match = GameMatch::find()->where(['id' => $match_id])->with(['prediction'])->one();

        if (!$match->canPredict()) {
            throw new ForbiddenHttpException();
        }

        /** @var Wallet $wallet */
        $wallet = Yii::$app->user->identity->wallet;

        if (!$wallet || $wallet->coins < 1) {
            throw new BadRequestHttpException();
        }

        $prediction = Prediction::find()->where([
            'match_id' => $match_id,
            'user_id' => Yii::$app->user->id
        ])->one();

        $predictionCounter = PredictionCounter::find()->where(['user_id' => Yii::$app->user->id])->one();

        if (!$predictionCounter) {
            $predictionCounter = new PredictionCounter();
            $predictionCounter->user_id = Yii::$app->user->id;
            $predictionCounter->predictions = 0;
            $predictionCounter->update_ts = date('Y-m-d H:i:s');
        }

        $currentPredictions = $predictionCounter->predictions;
        $currentPredictions += 1;
        $predictionCounter->predictions = $currentPredictions;
        $predictionCounter->save();

        if ($prediction) {
            throw new ForbiddenHttpException();
        }

        $prediction = new Prediction();
        $prediction->match_id = $match_id;
        $prediction->selected_team = $selected_team;
        $prediction->is_winner = 0;
        $prediction->user_id = Yii::$app->user->id;
        $prediction->save();

        $currentCoins = $wallet->coins;
        $currentCoins -= 1;
        $wallet->coins = $currentCoins;
        $wallet->save();

        return [
            'coins' => $currentCoins
        ];
    }
}
