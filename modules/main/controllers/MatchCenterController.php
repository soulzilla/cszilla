<?php

namespace app\modules\main\controllers;

use app\components\core\Controller;
use app\models\GameMatch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;

class MatchCenterController extends Controller
{
    public function actionIndex()
    {
        $query = GameMatch::find();
        $state = Yii::$app->request->get('state', 'active');

        if ($state == 'finished') {
            $query->andWhere([
                'is_finished' => 1
            ])->orderBy(['start_ts' => SORT_DESC]);
        } else {
            $query->andWhere([
                'is_finished' => 0
            ])->orderBy(['start_ts' => SORT_ASC]);
        }

        $query->with(['firstTeam', 'secondTeam', 'prediction']);

        $provider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('index', [
            'provider' => $provider,
            'state' => $state
        ]);
    }

    public function actionView($id)
    {
        /** @var GameMatch $model */
        $model = GameMatch::find()->where(['id' => $id])->with([
            'firstTeam', 'secondTeam', 'like', 'counter', 'prediction'
        ])->one();

        if (!$model) {
            throw new NotFoundHttpException();
        }

        $model->addView();

        return $this->render('view', [
            'model' => $model
        ]);
    }
}
