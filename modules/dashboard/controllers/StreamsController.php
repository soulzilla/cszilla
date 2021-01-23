<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\services\StreamsService;
use app\services\UsersService;

class StreamsController extends DashboardController
{
    public function __construct(
        $id, $module,
        UsersService $usersService,
        StreamsService $service,
        $config = []
    )
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }
}
