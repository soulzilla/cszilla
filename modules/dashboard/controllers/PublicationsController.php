<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\components\helpers\ArrayHelper;
use app\models\Category;
use app\services\CategoriesService;
use app\services\PublicationsService;
use app\services\UsersService;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\Exception;
use yii\web\Response;

class PublicationsController extends DashboardController
{
    private $categoriesService;

    public function __construct(
        $id,
        $module,
        UsersService $usersService,
        PublicationsService $service,
        CategoriesService $categoriesService,
        $config = []
    )
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
        $this->categoriesService = $categoriesService;
    }

    public function actionCreate()
    {
        $model = $this->service->getModel();
        $model->author_id = Yii::$app->user->id;
        $categoriesQuery = Category::find();
        $categoriesProvider = $this->categoriesService->getDataProvider($categoriesQuery);
        $categories = ArrayHelper::map($categoriesProvider->getModels(), 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'categories' => $categories
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->service->findOne($id);
        $categoriesQuery = Category::find();
        $categoriesProvider = $this->categoriesService->getDataProvider($categoriesQuery);
        $categories = ArrayHelper::map($categoriesProvider->getModels(), 'id', 'name');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'categories' => $categories
        ]);
    }
    /**
     * @param $id
     * @return Response
     */
    public function actionBlock($id)
    {
        $this->service->blockById($id);

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * @param $id
     * @return Response
     */
    public function actionUnblock($id)
    {
        $this->service->unblockById($id);

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * @param $id
     * @return Response
     */
    public function actionRestore($id)
    {
        $this->service->restoreById($id);

        return $this->redirect(Yii::$app->request->referrer);
    }
}