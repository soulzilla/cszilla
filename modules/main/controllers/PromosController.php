<?php

namespace app\modules\main\controllers;

use app\components\core\Controller;
use app\services\PromoCodesService;
use app\services\UsersService;
use yii\web\NotFoundHttpException;

class PromosController extends Controller
{
    private $promoCodesService;

    public function __construct(
        $id, $module,
        PromoCodesService $promoCodesService,
        UsersService $usersService,
        $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->promoCodesService = $promoCodesService;
    }

    public function beforeAction($action)
    {
        throw new NotFoundHttpException();
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->promoCodesService->findOneWithRelations($id)
        ]);
    }
}
