<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\services\TeamsService;
use app\services\UsersService;

/**
 * TeamsController implements the CRUD actions for Team model.
 */
class TeamsController extends DashboardController
{
    public function __construct($id, $module, TeamsService $service, UsersService $usersService, $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }
}
