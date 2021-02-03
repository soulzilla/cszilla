<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\services\CategoriesService;
use app\services\UsersService;

class CategoriesController extends DashboardController
{
    public function __construct($id, $module, UsersService $usersService, CategoriesService $service, $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }

    public function allowedRoles()
    {
        return ['ROLE_EDITOR'];
    }
}
