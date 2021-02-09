<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\services\GameMatchesService;
use app\services\UsersService;

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
}
