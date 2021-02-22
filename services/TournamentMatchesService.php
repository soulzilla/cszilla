<?php

namespace app\services;

use app\components\core\Service;
use app\models\TournamentMatch;

class TournamentMatchesService extends Service
{
    public function getModel()
    {
        return new TournamentMatch();
    }
}
