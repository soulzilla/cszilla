<?php

namespace app\services;

use app\components\core\ActiveQuery;
use app\components\core\Service;
use app\models\Prize;

class PrizesService extends Service
{
    public function getModel()
    {
        return new Prize();
    }

    public function prepareQuery(ActiveQuery $query)
    {
        $query->with(['contest']);
    }
}
