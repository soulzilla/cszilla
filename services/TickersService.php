<?php

namespace app\services;

use app\components\core\Service;
use app\models\Ticker;

class TickersService extends Service
{
    public function getModel()
    {
        return new Ticker();
    }
}
