<?php

namespace app\modules\main\controllers;

use app\behaviors\AjaxBehavior;
use app\components\core\Controller;
use app\models\Rating;
use Yii;

class RatingController extends Controller
{
    public function behaviors()
    {
        return [
            'ajax' => [
                'class' => AjaxBehavior::class
            ]
        ];
    }

    public function actionCreate()
    {
        $entity_id = Yii::$app->request->post('entity_id');
        $entity_table = Yii::$app->request->post('entity_table');
        $rate = Yii::$app->request->post('rate');

        $model = Rating::find()->where([
            'user_id' => Yii::$app->user->id,
            'entity_table' => $entity_table,
            'entity_id' => $entity_id
        ])->one();

        if (!$model) {
            $model = new Rating();
            $model->user_id = Yii::$app->user->id;
            $model->entity_table = $entity_table;
            $model->entity_id = $entity_id;
        }

        $model->rate = $rate;

        $model->save();

        return [
            'html' => $this->renderPartial('create', [
                'model' => $model
            ]),
            'count' => $model->count,
            'average' => $model->average
        ];
    }
}
