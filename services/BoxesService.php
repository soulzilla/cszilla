<?php

namespace app\services;

use app\components\core\ActiveQuery;
use app\components\core\Service;
use app\models\Box;

class BoxesService extends Service
{
    public function getModel()
    {
        return new Box();
    }

    public function prepareQuery(ActiveQuery $query)
    {
        parent::prepareQuery($query);
        $query->with(['site']);
    }
}
