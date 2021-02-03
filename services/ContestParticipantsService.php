<?php

namespace app\services;

use app\components\core\Service;
use app\models\ContestParticipant;

class ContestParticipantsService extends Service
{
    public function getModel()
    {
        return new ContestParticipant();
    }
}