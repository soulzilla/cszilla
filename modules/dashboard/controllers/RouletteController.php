<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\models\Boxes;
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

    public function actionBoxes($id)
    {
        $site = $this->service->findOne($id);
        $model = Boxes::find()->where([
            'site_id' => $id
        ])->one();

        if (!$model) {
            $model = new Boxes();
            $model->site_id = $site->id;
        }

        $postData = Yii::$app->request->post('Boxes');

        $model->attributes = $postData;

        if ($postData && $model->save()) {
            return $this->redirect(['view', 'id' => $site->id]);
        } else {
            dd($model->getErrors());
        }

        return $this->render('boxes', [
            'model' => $model,
            'site' => $site
        ]);
    }
}
