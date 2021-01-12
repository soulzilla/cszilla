<?php

namespace app\modules\main\controllers;

use app\components\core\Controller;
use app\forms\{AuthForm, PasswordChangeForm, RegistrationForm};
use app\models\{Comment, Complaint, Overview, Profile, Review, Stream, Video, User};
use app\services\{BookmakersService, CasinosService, LootBoxesService, PublicationsService, ReviewsService, UsersService};
use Yii;
use yii\base\Exception;
use yii\filters\VerbFilter;
use yii\web\{ForbiddenHttpException, NotFoundHttpException, Response};
use yii\bootstrap4\ActiveForm;

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
        ];
    }

    public function actionIndex()
    {
        $publications = $this->publicationsService->getLastSix();
        $reviews = $this->reviewsService->getPublishedReviews();
        $bookmakers = $this->bookmakersService->getTopFive();
        $casinos = $this->casinosService->getTopFive();
        $lootBoxes = $this->lootBoxesService->getTopFive();

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
        /* @var $model User */
        $model = Yii::$app->user->identity;

        $isOwnProfile = Yii::$app->user->id == $model->id;

        if (!$isOwnProfile) {
            throw new NotFoundHttpException();
        }

        $passwordForm = new PasswordChangeForm();

        if ($passwordData = Yii::$app->request->post('PasswordChangeForm')) {
            $passwordForm->attributes = $passwordData;
            if ($passwordForm->validate() && $this->usersService->changePassword($passwordForm)) {
                return $this->refresh();
            }
        }

        $profileForm = $model->profile;

        if ($profileData = Yii::$app->request->post('Profile')) {
            $profileForm->attributes = $profileData;

            if ($profileForm->validate() && $profileForm->save()) {
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
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionSettings()
    {
        if (!Yii::$app->request->isAjax) {
            throw new NotFoundHttpException();
        }

        /* @var $model Profile */
        $model = Yii::$app->user->identity->profile;

        $type = Yii::$app->request->get('type');
        $id = Yii::$app->request->get('id');
        $state = Yii::$app->request->get('state');

        $model->updateParam($type, $id, $state);
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

    /**
     * @return array|Response
     */
    public function actionOverview()
    {
        $model = new Overview();
        $model->user_id = Yii::$app->user->id;
        $model->attributes = Yii::$app->request->post('Overview');

        if ($model->validate() && $model->save()) {
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    /**
     * @return array|Response
     */
    public function actionComplaint()
    {
        $model = new Complaint();
        $model->user_id = Yii::$app->user->id;
        $model->attributes = Yii::$app->request->post('Complaint');

        if ($model->validate() && $model->save()) {
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    /**
     * @return array|Response
     */
    public function actionComment()
    {
        $model = new Comment();
        $model->user_id = Yii::$app->user->id;
        $model->attributes = Yii::$app->request->post('Comment');

        if ($model->validate() && $model->save()) {
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    /**
     * @return array|Response
     * @throws ForbiddenHttpException
     */
    public function actionStream()
    {
        if (!$this->usersService->isGranted(['ROLE_ADMIN'])) {
            throw new ForbiddenHttpException();
        }

        $model = new Stream();

        $postData = Yii::$app->request->post('Stream');

        if (isset($postData['id']) && ($id = $postData['id'])) {
            $model = Stream::findOne($id);
        }

        $model->attributes = $postData;

        if ($model->validate() && $model->save()) {
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    /**
     * @return array|Response
     * @throws ForbiddenHttpException
     */
    public function actionVideo()
    {
        if (!$this->usersService->isGranted(['ROLE_ADMIN'])) {
            throw new ForbiddenHttpException();
        }

        $model = new Video();
        $postData = Yii::$app->request->post('Video');

        if (isset($postData['id']) && ($id = $postData['id'])) {
            $model = Video::findOne($id);
        }

        $model->attributes = $postData;

        if ($model->validate() && $model->save()) {
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }
}
