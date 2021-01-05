<?php

namespace app\modules\main\controllers;

use app\components\core\Controller;
use app\services\LikesService;
use app\services\UsersService;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class LikeController extends Controller
{
    private $likesService;

    public function __construct(
        $id, $module,
        LikesService $likesService,
        UsersService $usersService,
        $config = []
    )
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->likesService = $likesService;
    }

    /**
     * @return array
     * @throws BadRequestHttpException
     * @throws NotFoundHttpException
     */
    public function actionCreate()
    {
        if (!Yii::$app->request->isAjax) {
            throw new NotFoundHttpException();
        }
        $recordId = Yii::$app->request->get('id');
        $recordTable = Yii::$app->request->get('table');
        if (!$recordTable || !$recordId) {
            throw new BadRequestHttpException();
        }
        $response = $this->likesService->like($recordId, $recordTable);

        Yii::$app->response->format = Response::FORMAT_JSON;
        return $response;
    }
}
