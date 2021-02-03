<?php

namespace app\modules\main\controllers;

use app\modules\main\controllers\base\PartnerController;
use app\services\LootBoxesService;
use app\services\UsersService;

class LootBoxesController extends PartnerController
{
    public function __construct(
        $id, $module,
        UsersService $usersService,
        LootBoxesService $lootBoxesService,
        $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->partnerService = $lootBoxesService;
    }
}