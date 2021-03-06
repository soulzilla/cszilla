<?php

namespace app\modules\main\controllers;

use app\behaviors\AjaxBehavior;
use app\components\core\Controller;
use app\forms\AuthForm;
use app\forms\PasswordChangeForm;
use app\forms\RegistrationForm;
use app\models\Message;
use app\models\Review;
use Yii;
use yii\bootstrap4\ActiveForm;
use yii\web\Response;

class ValidateController extends Controller
{
    public function behaviors()
    {
        return [
            'ajax' => AjaxBehavior::class,
        ];
    }

    public function actionAuth()
    {
        $model = new AuthForm();
        $model->attributes = Yii::$app->request->post('AuthForm');

        Yii::$app->response->format = Response::FORMAT_JSON;
        return ActiveForm::validate($model);
    }

    public function actionRegistration()
    {
        $model = new RegistrationForm();
        $model->attributes = Yii::$app->request->post('RegistrationForm');

        Yii::$app->response->format = Response::FORMAT_JSON;
        return ActiveForm::validate($model);
    }

    public function actionReview()
    {
        $model = new Review();
        $model->author_id = Yii::$app->user->id;
        $model->attributes = Yii::$app->request->post('Review');

        Yii::$app->response->format = Response::FORMAT_JSON;
        return ActiveForm::validate($model);
    }

    public function actionPassword()
    {
        $model = new PasswordChangeForm();
        $postData = Yii::$app->request->post('PasswordChangeForm');

        $model->attributes = $postData;

        Yii::$app->response->format = Response::FORMAT_JSON;
        return ActiveForm::validate($model);
    }

    public function actionContact()
    {
        $model = new Message();
        $postData = Yii::$app->request->post('Message');

        $model->attributes = $postData;
        $model->user_id = Yii::$app->user->id;

        Yii::$app->response->format = Response::FORMAT_JSON;
        return ActiveForm::validate($model);
    }
}
