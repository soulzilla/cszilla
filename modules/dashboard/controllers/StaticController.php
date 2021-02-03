<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\enums\StaticBlockEnum;
use app\models\StaticBlock;
use app\services\StaticBlocksService;
use app\services\UsersService;
use Yii;
use yii\web\NotFoundHttpException;

class StaticController extends DashboardController
{
    public function __construct(
        $id, $module,
        StaticBlocksService $service,
        UsersService $usersService,
        $config = []
    )
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }

    public function actionRefresh()
    {
        $types = StaticBlockEnum::keys();
        $existingModels = StaticBlock::find()->where(['in', 'type', $types])->all();
        $existingTypes = [];

        if ($existingModels) {
            foreach ($existingModels as $existingModel) {
                $existingTypes[] = $existingModel->type;
            }
        }

        $needTypes = array_diff($types, $existingTypes);

        foreach ($needTypes as $needType) {
            $model = new StaticBlock();
            $model->type = $needType;
            $model->save();
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionUpdate($type)
    {
        /* @var $model StaticBlock */
        $model = StaticBlock::find()->where(['type' => $type])->one();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    /**
     * @return string|void|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionCreate()
    {
        throw new NotFoundHttpException();
    }
}
