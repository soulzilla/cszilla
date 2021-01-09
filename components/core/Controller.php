<?php

namespace app\components\core;

use app\services\UsersService;
use Yii;
use yii\base\Action;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

abstract class Controller extends \yii\web\Controller
{
    /**
     * @var UsersService
     */
    protected $usersService;

    public function __construct($id, $module, UsersService $usersService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->usersService = $usersService;
        if (!$this->layout) {
            $this->layout = '@app/components/templates/layout';
        }
    }

    /**
     * @param Action $action
     * @return bool
     * @throws ForbiddenHttpException|BadRequestHttpException
     */
    public function beforeAction($action)
    {
        if ($noCache = Yii::$app->request->get('nocache')) {
            Yii::$app->cache->flush();
        }

        $isSuperAdmin = $this->usersService->isGranted(['ROLE_SUPER_ADMIN']);

        if (sizeof($this->allowedRoles()) && ($action->id != 'auth') && !$isSuperAdmin) {
            $isGranted = $this->usersService->isGranted($this->allowedRoles(), false);
            if (!$isGranted) {
                throw new ForbiddenHttpException("Access denied.");
            }
        }

        return parent::beforeAction($action);
    }

    /**
     * Список ролей, допущенные к просмотру этой страницы
     * @return array
     */
    public function allowedRoles()
    {
        return [];
    }

    public function actionError()
    {
        $publications = Yii::$app->publicationsService->getLastSix();
        return $this->render('@app/components/templates/error', [
            'code' => Yii::$app->errorHandler->exception->statusCode,
            'message' => Yii::$app->errorHandler->exception->getMessage(),
            'publications' => $publications
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    protected function ajaxOnly()
    {
        if (!Yii::$app->request->isAjax) {
            throw new NotFoundHttpException();
        }
    }
}
