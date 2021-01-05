<?php

namespace app\services;

use app\components\core\Service;
use app\models\Notification;

class NotificationsService extends Service
{
    public function getModel()
    {
        return new Notification();
    }
}