<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\models\Box;
use app\services\BoxesService;
use app\services\UsersService;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;

/**
 * BoxesController implements the CRUD actions for Box model.
 */
class BoxesController extends DashboardController
{
    public function __construct($id, $module, UsersService $usersService, BoxesService $service, $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }

    /**
     * Lists all Box models.
     * @param null $id
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionIndex($id = null)
    {
        if (!$id) {
            throw new BadRequestHttpException();
        }

        $query = Box::find()->where(['site_id' => $id]);

        $provider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('index', [
            'provider' => $provider
        ]);
    }

    public function actionDelete($id)
    {
        $model = $this->service->findOne($id);

        $model->delete();

        return $this->redirect(['index', 'id' => $model->site_id]);
    }
}
