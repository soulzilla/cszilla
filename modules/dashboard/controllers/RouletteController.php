<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\services\LootBoxesService;
use app\services\UsersService;

class RouletteController extends DashboardController
{
    public function __construct($id, $module, UsersService $usersService, LootBoxesService $service, $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }
}
