<?php

namespace app\services;

use app\components\core\Service;
use app\models\GameMode;

class GameModesService extends Service
{
    public function getModel()
    {
        return new GameMode();
    }
}
