<?php

namespace app\widgets\comments;

use app\models\Comment;
use yii\bootstrap4\Widget;
use yii\data\ActiveDataProvider;

class EntityComments extends Widget
{
    public $entity;

    public function run()
    {
        $query = Comment::find()->where([
            'comments.is_deleted' => 0,
            'comments.entity_id' => $this->entity->id,
            'comments.entity_table' => $this->entity->tableName()
        ])->andWhere([
            'is', 'comments.parent_id', null
        ])->joinWith([
            'author', 'counter', 'like'
        ])->orderBy([
            'comments.ts' => SORT_ASC
        ]);

        $provider = new ActiveDataProvider([
            'query' => $query
        ]);
        $provider->pagination->setPageSize(10);

        $comment = new Comment();
        $comment->entity_table = $this->entity->tableName();
        $comment->entity_id = $this->entity->id;

        return $this->render('entity', [
            'provider' => $provider,
            'comment' => $comment
        ]);
    }
}
