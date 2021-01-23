<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\services\CommentsService;
use app\services\UsersService;
use app\traits\ReadOnlyActionsTrait;

class CommentsController extends DashboardController
{
    use ReadOnlyActionsTrait;

    public function __construct(
        $id, $module,
        CommentsService $service,
        UsersService $usersService,
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
