<?php

namespace app\services;

use app\components\core\Service;
use app\models\Review;

class ReviewsService extends Service
{
    public function getModel()
    {
        return new Review();
    }

    public function hide($id)
    {
        Review::updateAll([
            'is_published' => 0
        ], [
            'id' => $id
        ]);
    }

    public function publish($id)
    {
        Review::updateAll([
            'is_published' => 1
        ], [
            'id' => $id
        ]);
    }

    public function getPublishedReviews()
    {
        return Review::find()
            ->where([
                'is_published' => 1
            ])->orderBy([
                'order' => SORT_ASC
            ])
            ->joinWith(['author'])
            ->limit(10)
            ->cache(300)
            ->all();
    }
}