<?php

namespace app\services;

use app\components\core\Service;
use app\models\Complaint;

class ComplaintsService extends Service
{
    public function getModel()
    {
        return new Complaint();
    }
}