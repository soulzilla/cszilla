<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\filters\PredictionsFilter;
use app\models\Prediction;
use app\models\PredictionCounter;
use app\services\GameMatchesService;
use app\services\UsersService;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

/**
 * MatchesController implements the CRUD actions for GameMatch model.
 */
class MatchesController extends DashboardController
{
    public function __construct($id, $module, UsersService $usersService, GameMatchesService $service, $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }

    public function actionTeams($q = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];

        if (!is_null($q)) {
            $query = new Query;
            $query->select('id, name AS text')
                ->from('teams')
                ->where(['like', 'name', $q])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }

        return $out;
    }

    public function actionReset()
    {
        if (!$this->usersService->isGranted(['ROLE_SUPER_ADMIN'])) {
            throw new ForbiddenHttpException();
        }

        PredictionCounter::updateAll([
            'predictions' => 0,
            'success_predictions' => 0,
            'win_rate' => '0'
        ]);

        Prediction::deleteAll();

        return $this->redirect('index');
    }

    public function actionCalc($user_id)
    {
        /** @var Prediction[] $predictions */
        $predictions = Prediction::find()->where(['user_id' => $user_id])->all();

        if (!sizeof($predictions)) {
            return $this->redirect(Yii::$app->request->referrer);
        }

        /** @var PredictionCounter $counter */
        $counter = PredictionCounter::find()->where(['user_id' => $user_id])->one();

        $counter->predictions = sizeof($predictions);
        $success = 0;
        foreach ($predictions as $prediction) {
            if (!$prediction->is_winner) {
                continue;
            }
            $success += 1;
        }

        $win_rate = (int) (($success/$counter->predictions)*100);

        $counter->win_rate = (string) $win_rate;
        $counter->save();

        return $this->redirect(Yii::$app->request->referrer);
    }


    public function actionPredictions()
    {
        $query = Prediction::find()->joinWith(['user', 'team']);
        $filter = new PredictionsFilter();
        $filter->applyFilter($query, Yii::$app->request->get());
        $provider = new ActiveDataProvider(['query' => $query]);

        return $this->render('predictions', [
            'provider' => $provider,
            'filter' => $filter
        ]);
    }
}
