<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\services\FaqService;
use app\services\UsersService;

/**
 * FaqController implements the CRUD actions for Faq model.
 */
class FaqController extends DashboardController
{
    public function __construct($id, $module, UsersService $usersService, FaqService $service, $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }
}
