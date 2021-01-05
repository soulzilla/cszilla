<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\services\BookmakersService;
use app\services\UsersService;

class BookmakersController extends DashboardController
{
    public function __construct($id, $module, UsersService $usersService, BookmakersService $service, $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }
}
