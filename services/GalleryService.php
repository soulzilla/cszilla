<?php

namespace app\services;

use app\components\core\ActiveQuery;
use app\components\core\Service;
use app\models\Gallery;

class GalleryService extends Service
{
    public function getModel()
    {
        return new Gallery();
    }

    public function prepareQuery(ActiveQuery $query)
    {
        parent::prepareQuery($query);
        $query->orderBy(['id' => SORT_DESC]);
    }
}
