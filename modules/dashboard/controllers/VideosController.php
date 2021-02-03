<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\services\UsersService;
use app\services\VideosService;

class VideosController extends DashboardController
{
    public function __construct(
        $id, $module,
        VideosService $service,
        UsersService $usersService,
        $config = []
    )
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }
}
