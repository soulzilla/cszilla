<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\services\BannersService;
use app\services\UsersService;

class BannersController extends DashboardController
{
    public function __construct($id, $module, UsersService $usersService, BannersService $service, $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }
}