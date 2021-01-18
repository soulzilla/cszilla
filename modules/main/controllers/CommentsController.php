<?php

namespace app\modules\main\controllers;

use app\behaviors\AjaxBehavior;
use app\components\core\Controller;
use app\models\Comment;
use Yii;
use yii\bootstrap4\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\db\StaleObjectException;
use yii\web\Response;

class CommentsController extends Controller
{
    public function behaviors()
    {
        return [
            'ajax' => [
                'class' => AjaxBehavior::class
            ]
        ];
    }

    public function actionIndex($page)
    {
        $entity_id = Yii::$app->request->get('entity_id');
        $entity_table = Yii::$app->request->get('entity_table');
        $page = (int) Yii::$app->request->get('page');

        $query = Comment::find()->where([
            'comments.is_deleted' => 0,
            'comments.entity_id' => $entity_id,
            'comments.entity_table' => $entity_table
        ])->andWhere([
            'is', 'comments.parent_id', null
        ])->joinWith([
            'author'
        ])->orderBy([
            'comments.ts' => SORT_ASC
        ]);

        $provider = new ActiveDataProvider([
            'query' => $query
        ]);

        $models = $provider->getModels();

        if (sizeof($models)) {
            return [
                'html' => $this->renderPartial('@app/components/templates/comments', ['models' => $models]),
                'nextPage' => $page+1
            ];
        }

        return [
            'html' => ''
        ];
    }

    public function actionCreate()
    {
        $model = new Comment();
        $model->user_id = Yii::$app->user->id;
        $model->entity_id = Yii::$app->request->post('entity_id');
        $model->entity_table = Yii::$app->request->post('entity_table');
        $model->content = Yii::$app->request->post('content');

        if ($model->validate() && $model->save()) {
            return [
                'html' => $this->renderPartial('@app/components/templates/comments', [
                    'models' => [$model]
                ])
            ];
        } else {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
    }

    /**
     * @param $id
     * @return array
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id)
    {
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