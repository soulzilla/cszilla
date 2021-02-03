<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\services\ComplaintsService;
use app\services\UsersService;
use app\traits\ReadOnlyActionsTrait;

class ComplaintsController extends DashboardController
{
    use ReadOnlyActionsTrait;

    public function __construct(
        $id, $module,
        ComplaintsService $service,
        UsersService $usersService,
        $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }

    public function allowedRoles()
    {
        return ['ROLE_MODERATOR'];
    }
}
