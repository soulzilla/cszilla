<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\services\TickersService;
use app\services\UsersService;

class TickersController extends DashboardController
{
    public function __construct($id, $module, UsersService $usersService, TickersService $service, $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }
}