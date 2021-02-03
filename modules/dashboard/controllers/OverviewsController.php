<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\services\OverviewsService;
use app\services\UsersService;
use app\traits\ReadOnlyActionsTrait;

class OverviewsController extends DashboardController
{
    use ReadOnlyActionsTrait;

    public function __construct(
        $id, $module,
        UsersService $usersService,
        OverviewsService $service,
        $config = []
    )
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }

    public function allowedRoles()
    {
        return ['ROLE_MODERATOR'];
    }
}
