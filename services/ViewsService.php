<?php

namespace app\services;

use app\components\core\Service;
use app\models\View;

class ViewsService extends Service
{
    public function getModel()
    {
        return new View();
    }
}