<?php

namespace app\services;

use app\components\core\Service;
use app\models\Comment;

class CommentsService extends Service
{
    public function getModel()
    {
        return new Comment();
    }
}
