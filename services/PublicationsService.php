<?php

namespace app\services;

use app\components\core\ActiveQuery;
use app\components\core\Service;
use app\traits\SoftDeleteTrait;
use app\models\Publication;
use yii\db\Expression;

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
        $query->with(['author', 'category'])->orderBy(['ts' => SORT_DESC]);
    }

    public function getLastSix()
    {
        return Publication::find()
            ->where([
                'publications.is_published' => 1,
                'publications.is_deleted' => 0,
                'publications.is_blocked' => 0
            ])->andWhere([
                '<', 'publications.publish_date', date('Y-m-d H:i:s')
            ])->joinWith([
                'category'
            ])->orderBy([
                'publications.publish_date' => SORT_DESC
            ])
            ->limit(6)->all();
    }
}