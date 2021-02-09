<?php

namespace app\services;

use app\models\WalletTask;

class WalletTasksService
{
    public function getModel()
    {
        return new WalletTask();
    }
}
