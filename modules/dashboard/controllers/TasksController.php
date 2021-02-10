<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\services\UsersService;
use app\services\WalletTasksService;

/**
 * TasksController implements the CRUD actions for WalletTask model.
 */
class TasksController extends DashboardController
{
    public function __construct($id, $module, UsersService $usersService, WalletTasksService $service, $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }
}
