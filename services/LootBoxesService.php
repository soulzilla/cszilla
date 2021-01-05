<?php

namespace app\services;

use app\components\core\Service;
use app\models\LootBox;

class LootBoxesService extends Service
{
    public function getModel()
    {
        return new LootBox();
    }

    public function getTopFive()
    {
        return LootBox::find()
            ->where([
                'loot_boxes.is_published' => 1,
                'loot_boxes.recommended' => 1
            ])->orderBy([
                'loot_boxes.order' => SORT_ASC
            ])
            ->limit(5)
            ->innerJoinWith(['promoCode'])
            ->all();
    }
}