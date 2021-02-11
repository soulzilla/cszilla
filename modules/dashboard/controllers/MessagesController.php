<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\services\MessagesService;
use app\services\UsersService;

/**
 * MessagesController implements the CRUD actions for Message model.
 */
class MessagesController extends DashboardController
{
    public function __construct($id, $module, UsersService $usersService, MessagesService $service, $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }
}
