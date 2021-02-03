<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\traits\CreateActionByEntityTrait;
use app\services\BonusesService;
use app\services\UsersService;

class BonusesController extends DashboardController
{
    use CreateActionByEntityTrait;

    public function __construct($id, $module, UsersService $usersService, BonusesService $service, $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }
}
