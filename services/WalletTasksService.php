<?php

namespace app\services;

use app\components\core\Service;
use app\models\WalletTask;

class WalletTasksService extends Service
{
    public function getModel()
    {
        return new WalletTask();
    }
}
