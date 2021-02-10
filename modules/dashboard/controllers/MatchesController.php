<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\models\Prediction;
use app\models\PredictionCounter;
use app\services\GameMatchesService;
use app\services\UsersService;
use yii\web\ForbiddenHttpException;

/**
 * MatchesController implements the CRUD actions for GameMatch model.
 */
class MatchesController extends DashboardController
{
    public function __construct($id, $module, UsersService $usersService, GameMatchesService $service, $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }

    public function actionReset()
    {
        if (!$this->usersService->isGranted(['ROLE_SUPER_ADMIN'])) {
            throw new ForbiddenHttpException();
        }

        PredictionCounter::updateAll([
            'predictions' => 0,
            'success_predictions' => 0,
            'win_rate' => '0'
        ]);

        Prediction::deleteAll();

        return $this->redirect('index');
    }
}
