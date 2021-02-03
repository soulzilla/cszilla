<?php

namespace app\services;

use app\components\core\ActiveQuery;
use app\components\core\Service;
use app\models\Overview;

class OverviewsService extends Service
{
    public function getModel()
    {
        return new Overview();
    }

    public function prepareQuery(ActiveQuery $query)
    {
        $query->joinWith(['author'])->orderBy(['overviews.ts' => SORT_DESC]);
    }
}
