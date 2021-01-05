<?php

namespace app\services;

use app\components\core\Service;
use app\models\Rating;

class RatingsService extends Service
{
    public function getModel()
    {
        return new Rating();
    }
}