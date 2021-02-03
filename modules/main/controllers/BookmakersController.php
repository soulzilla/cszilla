<?php

namespace app\modules\main\controllers;

use app\modules\main\controllers\base\PartnerController;
use app\services\BookmakersService;
use app\services\UsersService;

class BookmakersController extends PartnerController
{
    public function __construct(
        $id, $module,
        UsersService $usersService,
        BookmakersService $bookmakersService,
        $config = []
    )
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->partnerService = $bookmakersService;
    }
}
