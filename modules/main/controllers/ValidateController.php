<?php

namespace app\modules\main\controllers;

use app\components\core\Controller;
use app\forms\AuthForm;
use app\forms\PasswordChangeForm;
use app\forms\RegistrationForm;
use app\models\Review;
use app\models\Stream;
use app\models\Video;
use Yii;
use yii\bootstrap4\ActiveForm;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

class ValidateController extends Controller
{
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

    public function actionStream()
    {
        $model = new Stream();

        $postData = Yii::$app->request->post('Stream');

        if (isset($postData['id']) && ($id = $postData['id'])) {
            $model = Stream::findOne($id);
        }

        $model->attributes = $postData;

        Yii::$app->response->format = Response::FORMAT_JSON;
        return ActiveForm::validate($model);
    }

    public function actionVideo()
    {
        $model = new Video();
        $postData = Yii::$app->request->post('Video');

        if (isset($postData['id']) && ($id = $postData['id'])) {
            $model = Video::findOne($id);
        }

        $model->attributes = $postData;

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
}
