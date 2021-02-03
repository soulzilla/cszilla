<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\services\CasinosService;
use app\services\UsersService;

class CasinosController extends DashboardController
{
    public function __construct($id, $module, UsersService $usersService, CasinosService $service, $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }
}
