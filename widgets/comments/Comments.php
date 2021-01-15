<?php

namespace app\widgets\comments;

use app\models\Comment;
use yii\bootstrap4\Widget;

class Comments extends Widget
{
    public function run()
    {
        $models = Comment::find()->where([
            'is_deleted' => 0,
            'is_blocked' => 0,
        ])->andWhere([
            'is', 'parent_id', null
        ])->joinWith([
            'author'
        ])->with([
            'entity'
        ])->orderBy([
            'ts' => SORT_DESC
        ])->limit(5)->all();

        return $this->render('index', [
            'models' => $models
        ]);
    }
}
