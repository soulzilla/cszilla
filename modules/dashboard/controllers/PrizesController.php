<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\services\PrizesService;
use app\services\UsersService;

class PrizesController extends DashboardController
{
    public function __construct($id, $module, UsersService $usersService, PrizesService $service, $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }
}
