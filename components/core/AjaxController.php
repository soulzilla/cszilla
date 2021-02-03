<?php

namespace app\components\core;

use Yii;
use yii\base\Action;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class AjaxController extends Controller
{
    /**
     * @param Action $action
     * @return bool
     * @throws NotFoundHttpException
     * @throws BadRequestHttpException
     * @throws ForbiddenHttpException
     */
    public function beforeAction($action)
    {
        if (!Yii::$app->request->isAjax) {
            throw new NotFoundHttpException();
        }

        Yii::$app->response->format = Response::FORMAT_JSON;

        return parent::beforeAction($action);
    }
}
