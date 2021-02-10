<?php

namespace app\modules\main\controllers;

use app\components\core\Controller;
use app\models\GameMatch;
use Yii;
use yii\data\ActiveDataProvider;

class MatchCenterController extends Controller
{
    public function actionIndex()
    {
        $query = GameMatch::find()->orderBy(['start_ts' => SORT_DESC]);
        $state = Yii::$app->request->get('state', 'active');

        if ($state == 'finished') {
            $query->andWhere([
                'is_finished' => 1
            ]);
        } else {
            $query->andWhere([
                'is_finished' => 0
            ]);
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
        $model = GameMatch::find()->where(['id' => $id])->with([
            'firstTeam', 'secondTeam', 'like', 'counter', 'prediction'
        ])->one();

        return $this->render('view', [
            'model' => $model
        ]);
    }
}
