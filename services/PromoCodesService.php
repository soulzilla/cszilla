<?php

namespace app\services;

use app\components\core\ActiveQuery;
use app\components\core\Service;
use app\models\PromoCode;

class PromoCodesService extends Service
{
    public function getModel()
    {
        return new PromoCode();
    }

    public function prepareQuery(ActiveQuery $query)
    {
        $query->with(['bookmaker', 'casino', 'lootBox']);
    }
}
