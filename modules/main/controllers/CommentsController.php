<?php

namespace app\modules\main\controllers;

use app\components\core\Controller;
use app\models\Comment;
use Yii;
use yii\db\StaleObjectException;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class CommentsController extends Controller
{
    /**
     * @param $id
     * @return array
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id)
    {
        if (!Yii::$app->request->isAjax) {
            throw new NotFoundHttpException();
        }

        $model = Comment::findOne($id);

        if ($model->canDelete()) {
            $model->delete();
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        return [
            'count' => Comment::find()->where([
                'is_deleted' => 0,
                'entity_id' => $model->entity_id,
                'entity_table' => $model->entity_table
            ])->count()
        ];
    }
}