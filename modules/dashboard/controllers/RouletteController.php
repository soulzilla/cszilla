<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\models\Attachment;
use app\services\LootBoxesService;
use app\services\UsersService;
use Yii;

class RouletteController extends DashboardController
{
    public function __construct($id, $module, UsersService $usersService, LootBoxesService $service, $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }

    public function actionUpdate($id)
    {
        $model = $this->service->findOne($id);

        $attachments = Attachment::find()->where([
            'entity_id' => $model->id,
            'entity_table' => $model->tableName()
        ])->all();

        if (sizeof($attachments)) {
            $data = [];
            foreach ($attachments as $attachment) {
                $data[] = [
                    'type' => $attachment->type,
                    'source' => $attachment->source
                ];
            }
            $model->attachments = $data;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }
}
