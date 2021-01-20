<?php

namespace app\services;

use app\components\core\ActiveQuery;
use app\components\core\Service;
use app\models\Comment;

class CommentsService extends Service
{
    public function getModel()
    {
        return new Comment();
    }

    public function prepareQuery(ActiveQuery $query)
    {
        $query->joinWith(['author'])->orderBy(['comments.ts' => SORT_DESC]);
    }
}
