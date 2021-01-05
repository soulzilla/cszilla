<?php

namespace app\services;

use app\components\core\Service;
use app\models\Overview;

class OverviewsService extends Service
{
    public function getModel()
    {
        return new Overview();
    }
}