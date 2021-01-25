<?php

namespace app\services;

use app\components\core\Service;
use app\models\Casino;

class CasinosService extends Service
{
    public function getModel()
    {
        return new Casino();
    }

    public function getTopFive()
    {
        return Casino::find()
            ->where([
                'casinos.is_published' => 1,
                'casinos.recommended' => 1
            ])->orderBy([
                'casinos.order' => SORT_ASC
            ])
            ->limit(5)
            ->joinWith(['counter', 'rating'])
            ->innerJoinWith(['bonus'])
            ->cache(300)
            ->all();
    }
}
