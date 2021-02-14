<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\forms\RegistrationForm;
use app\services\UsersService;
use Yii;
use yii\base\InvalidConfigException;
use yii\db\Exception;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * Class UsersController
 * @package app\modules\dashboard\controllers
 */
class UsersController extends DashboardController
{
    public function __construct($id, $module, UsersService $usersService, $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $usersService;
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index', 'update', 'delete', 'block', 'unblock', 'registration'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post'],
                    'restore' => ['post'],
                    'block' => ['post'],
                    'unblock' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @return string|Response
     * @throws \yii\base\Exception
     */
    public function actionRegistration()
    {
        $model = new RegistrationForm();
        $model->attributes = $post = Yii::$app->request->post('RegistrationForm');

        if ($post && $user = $this->usersService->register($model)) {
            return $this->redirect(['view', 'id' => $user->getId()]);
        }

        return $this->render('registration', [
            'model' => $model
        ]);
    }

    public function actionSearch($q = null)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = ['results' => ['id' => '', 'text' => '']];

        if (!is_null($q)) {
            $query = new Query;
            $query->select('user_id AS id, name AS text')
                ->from('profiles')
                ->where(['like', 'name', $q])
                ->limit(20);
            $command = $query->createCommand();
            $data = $command->queryAll();
            $out['results'] = array_values($data);
        }

        return $out;
    }

    /**
     * @param $id
     * @return Response
     * @throws InvalidConfigException
     * @throws Exception
     */
    public function actionBlock($id)
    {
        $this->service->blockById($id);

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * @param $id
     * @return Response
     */
    public function actionUnblock($id)
    {
        $this->service->unblockById($id);

        return $this->redirect(Yii::$app->request->referrer);
    }

    /**
     * @param $id
     * @return Response
     */
    public function actionRestore($id)
    {
        $this->service->restoreById($id);

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function allowedRoles()
    {
        return ['ROLE_SPECIAL_USERS'];
    }
}
