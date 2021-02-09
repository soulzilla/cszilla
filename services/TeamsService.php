<?php

namespace app\services;

use app\components\core\Service;
use app\models\Team;

class TeamsService extends Service
{
    public function getModel()
    {
        return new Team();
    }
}
