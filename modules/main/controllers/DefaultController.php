<?php

namespace app\modules\main\controllers;

use app\behaviors\AjaxBehavior;
use app\components\core\Controller;
use app\components\helpers\StringHelper;
use app\forms\{AuthForm, PasswordChangeForm, RegistrationForm};
use app\models\{Message, Page, Profile, Review, User};
use app\services\{BookmakersService, CasinosService, LootBoxesService, PublicationsService, ReviewsService, UsersService};
use Yii;
use yii\base\Exception;
use yii\filters\VerbFilter;
use yii\web\{NotFoundHttpException, Response};

class DefaultController extends Controller
{
    private $publicationsService;
    private $reviewsService;
    private $bookmakersService;
    private $casinosService;
    private $lootBoxesService;

    public function __construct(
        $id, $module,
        UsersService $usersService,
        PublicationsService $publicationsService,
        ReviewsService $reviewsService,
        BookmakersService $bookmakersService,
        CasinosService $casinosService,
        LootBoxesService $lootBoxesService,
        $config = []
    )
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->publicationsService = $publicationsService;
        $this->reviewsService = $reviewsService;
        $this->bookmakersService = $bookmakersService;
        $this->casinosService = $casinosService;
        $this->lootBoxesService = $lootBoxesService;
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
            'ajax' => [
                'class' => AjaxBehavior::class,
                'actions' => ['settings']
            ]
        ];
    }

    public function actionIndex()
    {
        $publications = $this->publicationsService->getLastSix();
        $reviews = $this->reviewsService->getPublishedReviews();
        $bookmakers = $this->bookmakersService->getTopFive();
        $casinos = $this->casinosService->getTopFive();
        $lootBoxes = $this->lootBoxesService->getTopFive();

        Yii::$app->seo->revisit = 1;

        return $this->render('index', [
            'publications' => $publications,
            'reviews' => $reviews,
            'bookmakers' => $bookmakers,
            'casinos' => $casinos,
            'lootBoxes' => $lootBoxes
        ]);
    }

    /**
     * @return array|Response
     * @throws Exception
     */
    public function actionRegistration()
    {
        $model = new RegistrationForm();
        $model->attributes = Yii::$app->request->post('RegistrationForm');
        $model->email_confirmed = 0;

        if ($user = $this->usersService->register($model)) {
            Yii::$app->user->login($user);
            return $this->redirect(['/main']);
        }
        
        Yii::$app->session->setFlash('error', 'Произошла ошибка. Попробуйте ещё раз.');

        return $this->goHome();
    }

    /**
     * @return array|Response
     * @throws NotFoundHttpException
     */
    public function actionAuth()
    {
        $model = new AuthForm();
        $model->attributes = Yii::$app->request->post('AuthForm');

        if ($this->usersService->login($model)) {
            return $this->goBack();
        }
        Yii::$app->session->setFlash('error', 'Произошла ошибка. Попробуйте ещё раз.');

        return $this->goHome();
    }

    /**
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goBack();
    }

    /**
     * @param $username
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionProfile($username)
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['index']);
        }

        /* @var $model User */
        $model = Yii::$app->user->identity;

        $isOwnProfile = $model->name == $username;

        if (!$isOwnProfile) {
            throw new NotFoundHttpException();
        }

        $passwordForm = new PasswordChangeForm();

        if ($passwordData = Yii::$app->request->post('PasswordChangeForm')) {
            $passwordForm->attributes = $passwordData;
            if ($passwordForm->validate() && $this->usersService->changePassword($passwordForm)) {
                Yii::$app->session->setFlash('success', 'Пароль изменён.');
                return $this->refresh();
            }
        }

        $profileForm = $model->profile;

        if ($profileData = Yii::$app->request->post('Profile')) {
            $profileForm->attributes = $profileData;

            if ($profileForm->validate() && $profileForm->save()) {
                Yii::$app->session->setFlash('success', 'Изменения сохранены.');
                return $this->refresh();
            }
        }

        return $this->render('profile', [
            'model' => $model,
            'passwordForm' => $passwordForm,
            'profileForm' => $profileForm
        ]);
    }

    /**
     * @return array
     */
    public function actionSettings()
    {
        /* @var $model Profile */
        $model = Yii::$app->user->identity->profile;

        $type = Yii::$app->request->get('type');
        $id = Yii::$app->request->get('id');
        $state = Yii::$app->request->get('state');

        $model->updateParam($type, $id, $state);

        return ['status' => 'ok'];
    }

    /**
     * @return array|Response
     */
    public function actionReview()
    {
        $model = new Review();
        $model->author_id = Yii::$app->user->id;
        $model->attributes = Yii::$app->request->post('Review');

        if ($model->validate() && $model->save()) {
            return $this->redirect(Yii::$app->request->referrer);
        }

        Yii::$app->session->setFlash('error', 'Произошла ошибка. Попробуйте ещё раз.');

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new Message();
        $model->user_id = Yii::$app->user->id;
        $model->attributes = Yii::$app->request->post('Message');

        if ($model->validate() && $model->save()) {
            return $this->redirect(Yii::$app->request->referrer);
        }

        Yii::$app->session->setFlash('error', 'Произошла ошибка. Попробуйте ещё раз.');

        return $this->goHome();
    }

    public function actionPage($title_canonical)
    {
        /** @var Page $model */
        $model = Page::find()
            ->where(['title_canonical' => $title_canonical, 'is_published' => 1])
            ->with(['counter', 'like', 'seo'])
            ->cache(300)
            ->one();

        if (!$model) {
            throw new NotFoundHttpException();
        }

        $model->addView();

        if ($model->seo) {
            Yii::$app->seo->keywords = $model->seo->keywords ?? StringHelper::getDefaultKeywords();
            Yii::$app->seo->description = $model->seo->description ?? StringHelper::getDefaultDescription();
            Yii::$app->seo->title = $model->seo->title ?? $model->title;
            Yii::$app->seo->robots = $model->seo->noindex ? 'noindex, nofollow' : 'index, follow';
        }

        $pages = Page::find()
            ->where(['is_published' => 1])
            ->orderBy(['order' => SORT_ASC])
            ->cache(300)
            ->all();

        return $this->render('page', [
            'model' => $model,
            'pages' => $pages
        ]);
    }
}
