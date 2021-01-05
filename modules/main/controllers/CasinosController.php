<?php

namespace app\modules\main\controllers;

use app\modules\main\controllers\base\PartnerController;
use app\services\CasinosService;
use app\services\UsersService;

class CasinosController extends PartnerController
{
    public function __construct(
        $id, $module,
        UsersService $usersService,
        CasinosService $casinosService,
        $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->partnerService = $casinosService;
    }
}