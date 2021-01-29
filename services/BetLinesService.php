<?php

namespace app\services;

use app\components\core\ActiveQuery;
use app\components\core\Service;
use app\models\BetLine;

class BetLinesService extends Service
{
    public function getModel()
    {
        return new BetLine();
    }

    public function prepareQuery(ActiveQuery $query)
    {
        parent::prepareQuery($query);
        $query->with(['bookmaker']);
    }
}
