<?php

namespace app\modules\main\controllers;

use app\components\core\Controller;
use app\models\Tournament;
use Yii;
use yii\data\ActiveDataProvider;

class TournamentsController extends Controller
{
    public function actionIndex()
    {
        $query = Tournament::find()->andWhere([
            'is_published' => 1
        ]);

        $state = Yii::$app->request->get('state', 'active');
        if ($state == 'active') {
            $query->andWhere(['is_finished' => 0])->orderBy(['date_start' => SORT_ASC]);
        } else {
            $query->andWhere(['is_finished' => 1])->orderBy(['date_start' => SORT_DESC]);
        }

        $provider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('index', [
            'provider' => $provider,
            'state' => $state
        ]);
    }
}
