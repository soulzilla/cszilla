<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\models\BetLine;
use app\services\BetLinesService;
use app\services\UsersService;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;

/**
 * LinesController implements the CRUD actions for BetLine model.
 */
class LinesController extends DashboardController
{
    public function __construct($id, $module, UsersService $usersService, BetLinesService $service, $config = [])
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

        $query = BetLine::find()->where(['bookmaker_id' => $id]);

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

        return $this->redirect(['index', 'id' => $model->bookmaker_id]);
    }
}
