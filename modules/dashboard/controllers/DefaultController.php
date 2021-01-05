<?php

namespace app\modules\dashboard\controllers;

use app\components\core\Controller;
use app\forms\AuthForm;
use app\services\LikesService;
use app\services\PublicationsService;
use app\services\UsersService;
use app\services\ViewsService;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Url;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Default controller for the `dashboard` module
 */
class DefaultController extends Controller
{
    public $layout = '@app/modules/dashboard/views/layouts/main';

    private $likesService;
    private $viewsService;
    private $publicationsService;

    public function __construct(
        $id, $module,
        UsersService $usersService,
        LikesService $likesService,
        ViewsService $viewsService,
        PublicationsService $publicationsService,
        $config = []
    )
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->likesService = $likesService;
        $this->viewsService = $viewsService;
        $this->publicationsService = $publicationsService;
    }

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post']
                ],
            ],
            'access' => [
                'class' => AccessControl::class,
                'only' => ['login', 'logout', 'index'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['logout', 'index'],
                        'roles' => ['@'],
                    ]
                ]
            ]
        ];
    }

    public function beforeAction($action)
    {
        if (Yii::$app->user->isGuest && $action->id != 'auth') {
            return $action->controller->redirect(['/dashboard/auth']);
        }

        return parent::beforeAction($action);
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'usersCount' => $this->usersService->getTotalCount(),
            'likesCount' => $this->likesService->getTotalCount(),
            'viewsCount' => $this->viewsService->getTotalCount(),
            'publicationsCount' => $this->publicationsService->getTotalCount(),
        ]);
    }

    /**
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionAuth()
    {
        $redirect = Yii::$app->request->get('return') ?? Url::to(['/dashboard']);

        if (!Yii::$app->user->isGuest) {
            return $this->redirect($redirect);
        }

        $model = new AuthForm();

        if (Yii::$app->request->post('AuthForm')) {
            $model->attributes = Yii::$app->request->post('AuthForm');

            if ($this->usersService->login($model)) {
                return $this->redirect($redirect);
            }
        }

        return $this->render('auth', [
            'model' => $model
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function allowedRoles()
    {
        return ['ROLE_ADMIN', 'ROLE_SUPER_ADMIN'];
    }
}
