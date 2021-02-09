<?php

namespace app\services;

use app\components\core\Service;
use app\models\GameMatch;

class GameMatchesService extends Service
{
    public function getModel()
    {
        return new GameMatch();
    }
}
