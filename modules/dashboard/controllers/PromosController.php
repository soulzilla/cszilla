<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\components\traits\CreateActionByEntityTrait;
use app\services\PromoCodesService;
use app\services\UsersService;

class PromosController extends DashboardController
{
    use CreateActionByEntityTrait;

    public function __construct($id, $module, UsersService $usersService, PromoCodesService $service, $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }
}