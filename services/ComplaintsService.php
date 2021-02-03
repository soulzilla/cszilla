<?php

namespace app\services;

use app\components\core\{ActiveQuery, Service};
use app\models\Complaint;

class ComplaintsService extends Service
{
    public function getModel()
    {
        return new Complaint();
    }

    public function prepareQuery(ActiveQuery $query)
    {
        $query->joinWith(['author'])->orderBy(['complaints.ts' => SORT_DESC]);
    }
}