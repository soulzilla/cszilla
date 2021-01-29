<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\services\GameModesService;
use app\services\UsersService;
use app\models\GameMode;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;

/**
 * ModesController implements the CRUD actions for GameMode model.
 */
class ModesController extends DashboardController
{
    public function __construct($id, $module, UsersService $usersService, GameModesService $service, $config = [])
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

        $query = GameMode::find()->where(['casino_id' => $id]);

        $provider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('index', [
            'provider' => $provider
        ]);
    }
}
