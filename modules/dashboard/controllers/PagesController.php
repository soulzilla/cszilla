<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\services\PagesService;
use app\services\UsersService;

/**
 * PagesController implements the CRUD actions for Page model.
 */
class PagesController extends DashboardController
{
    public function __construct($id, $module, UsersService $usersService, PagesService $service, $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }
}
