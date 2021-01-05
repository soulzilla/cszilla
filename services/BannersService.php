<?php

namespace app\services;

use app\components\core\Service;
use app\models\Banner;

class BannersService extends Service
{
    public function getModel()
    {
        return new Banner();
    }
}