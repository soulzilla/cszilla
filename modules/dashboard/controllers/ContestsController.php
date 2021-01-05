<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\services\ContestsService;
use app\services\UsersService;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ContestsController extends DashboardController
{
    public function __construct($id, $module, UsersService $usersService, ContestsService $service, $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }

    public function actionRoll($id)
    {
        $model = $this->service->findOne($id);

        return $this->render('roll', [
            'model' => $model
        ]);
    }

    /**
     * @param $id
     * @return array
     * @throws NotFoundHttpException
     */
    public function actionWinner($id)
    {
        if (!Yii::$app->request->isAjax) {
            throw new NotFoundHttpException();
        }
        $place = (int) Yii::$app->request->get('place');

        $response = $this->service->roll($id, $place);

        Yii::$app->response->format = Response::FORMAT_JSON;

        return $response;
    }
}
