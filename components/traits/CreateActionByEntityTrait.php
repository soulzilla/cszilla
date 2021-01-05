<?php

namespace app\components\traits;

use Yii;
use yii\web\BadRequestHttpException;
use yii\web\Response;

trait CreateActionByEntityTrait
{
    /**
     * @return string|Response
     * @throws BadRequestHttpException
     */
    public function actionCreate()
    {
        $model = $this->service->getModel();
        $model->entity_id = Yii::$app->request->get('entity_id');
        $model->entity_table = Yii::$app->request->get('entity_table');
        if (!$model->entity_id || !$model->entity_table) {
            throw new BadRequestHttpException('Параметры переданы неверно.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }
}