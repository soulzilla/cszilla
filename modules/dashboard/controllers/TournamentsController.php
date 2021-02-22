<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\enums\TournamentFormatEnum;
use app\services\TournamentsService;
use app\services\UsersService;
use Yii;
use yii\db\Query;
use yii\web\Response;

/**
 * TournamentsController implements the CRUD actions for Tournament model.
 */
class TournamentsController extends DashboardController
{
    public function __construct(
        $id, $module,
        UsersService $usersService,
        TournamentsService $service,
        $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }

    public function actionTeams($q = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];

        $tournament_id = Yii::$app->request->get('tournament_id');
        $tournament = $this->service->findOne($tournament_id);

        if ($tournament->format == TournamentFormatEnum::FORMAT_1V1) {
            if (!is_null($q)) {
                $query = new Query;
                $query->select('id, name AS text')
                    ->from('profiles')
                    ->where(['like', 'name', $q])
                    ->limit(20);
                $command = $query->createCommand();
                $data = $command->queryAll();
                $out['results'] = array_values($data);
            }
        } else {
            if (!is_null($q)) {
                $query = new Query;
                $query->select('id, name AS text')
                    ->from('custom_teams')
                    ->where(['like', 'name', $q])
                    ->limit(20);
                $command = $query->createCommand();
                $data = $command->queryAll();
                $out['results'] = array_values($data);
            }
        }

        return $out;
    }
}
