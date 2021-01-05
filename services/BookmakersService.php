<?php

namespace app\services;

use app\components\core\Service;
use app\models\Bookmaker;

class BookmakersService extends Service
{
    public function getModel()
    {
        return new Bookmaker();
    }

    public function getTopFive()
    {
        return Bookmaker::find()
            ->where([
                'bookmakers.is_published' => 1,
                'bookmakers.recommended' => 1
            ])->orderBy([
                'bookmakers.order' => SORT_ASC
            ])
            ->limit(5)
            ->innerJoinWith(['bonus'])
            ->all();
    }
}
