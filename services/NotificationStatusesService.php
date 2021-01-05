<?php

namespace app\services;

use app\components\core\Service;
use app\models\NotificationStatus;

class NotificationStatusesService extends Service
{
    public function getModel()
    {
        return new NotificationStatus();
    }
}