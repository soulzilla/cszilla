<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\models\Attachment;
use app\models\RelatedPublication;
use app\services\CasinosService;
use app\services\UsersService;
use Yii;

class CasinosController extends DashboardController
{
    public function __construct($id, $module, UsersService $usersService, CasinosService $service, $config = [])
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

        $related_publications = RelatedPublication::find()->where([
            'entity_id' => $model->id,
            'entity_table' => $model->tableName()
        ])->with(['publication'])->all();

        if (sizeof($related_publications)) {
            $data = [];
            foreach ($related_publications as $related_publication) {
                if (!$related_publication->publication) {
                    continue;
                }
                $data[$related_publication->publication_id] = $related_publication->publication->title;
            }
            $model->related_publications = $data;
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }
}
