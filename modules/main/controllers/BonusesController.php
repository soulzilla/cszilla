<?php

namespace app\modules\main\controllers;

use app\components\core\Controller;
use app\services\BonusesService;
use app\services\UsersService;

class BonusesController extends Controller
{
    private $bonusesService;

    public function __construct(
        $id, $module,
        BonusesService $bonusesService,
        UsersService $usersService,
        $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->bonusesService = $bonusesService;
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->bonusesService->oneBonusWithRelations($id)
        ]);
    }
}
