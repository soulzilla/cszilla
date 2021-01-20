<?php

namespace app\modules\main\controllers;

use app\behaviors\AjaxBehavior;
use app\components\core\Controller;
use app\models\Complaint;
use Yii;
use yii\bootstrap4\ActiveForm;
use yii\db\StaleObjectException;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class ComplaintsController extends Controller
{
    public function behaviors()
    {
        return [
            'ajax' => [
                'class' => AjaxBehavior::class,
                'actions' => ['delete']
            ]
        ];
    }

    /**
     * @param $id
     * @return string[]
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id)
    {
        if (!$this->usersService->isGranted(['ROLE_SUPER_ADMIN'])) {
            throw new ForbiddenHttpException();
        }

        $model = Complaint::findOne($id);

        if (!$model) {
            throw new NotFoundHttpException();
        }

        if ($model->canDelete()) {
            $model->delete();
        }

        return ['status' => 'ok'];
    }

    public function actionCreate()
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
}
