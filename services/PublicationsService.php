<?php

namespace app\services;

use app\components\core\ActiveQuery;
use app\components\core\Service;
use app\traits\SoftDeleteTrait;
use app\models\Publication;

class PublicationsService extends Service
{
    use SoftDeleteTrait;

    public function restoreById($id)
    {
        Publication::updateAll(['is_deleted' => 0, 'is_published' => 0], ['id' => $id]);
    }

    public function getModel()
    {
        return new Publication();
    }

    public function prepareQuery(ActiveQuery $query)
    {
        $query->with(['author', 'category']);
    }

    public function getLastSix()
    {
        return Publication::find()
            ->where([
                'publications.is_published' => 1,
                'publications.is_deleted' => 0,
                'publications.is_blocked' => 0
            ])->joinWith([
                'category',
                'author'
            ])->orderBy([
                'publications.publish_date' => SORT_DESC
            ])
            ->limit(6)->all();
    }
}