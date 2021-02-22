<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\services\TournamentMatchesService;
use app\services\UsersService;
use Yii;
use yii\web\BadRequestHttpException;

/**
 * TmatchesController implements the CRUD actions for TournamentMatch model.
 */
class TmatchesController extends DashboardController
{
    public function __construct(
        $id, $module,
        UsersService $usersService,
        TournamentMatchesService $service,
        $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }

    public function actionCreate($tournament_id = null)
    {
        if (!$tournament_id) {
            throw new BadRequestHttpException();
        }

        $model = $this->service->getModel();
        $model->tournament_id = $tournament_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }
}
