<?php

namespace app\widgets\comments;

use app\models\Comment;
use yii\bootstrap4\Widget;

class EntityComments extends Widget
{
    public $entity;

    public function run()
    {
        $models = Comment::find()->where([
            'is_deleted' => 0,
            'entity_id' => $this->entity->id,
            'entity_table' => $this->entity->tableName()
        ])->andWhere([
            'is', 'parent_id', null
        ])->with([
            'author'
        ])->orderBy([
            'ts' => SORT_ASC
        ])->all();

        $comment = new Comment();
        $comment->entity_table = $this->entity->tableName();
        $comment->entity_id = $this->entity->id;

        return $this->render('entity', [
            'models' => $models,
            'comment' => $comment
        ]);
    }
}
