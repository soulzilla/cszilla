<?php

namespace app\enums;

use app\components\core\Enum;

class FaqCategoriesEnum extends Enum
{
    const CATEGORY_GENERAL = 1;
    const CATEGORY_BOOKMAKERS = 2;
    const CATEGORY_CASINOS = 3;
    const CATEGORY_LOOT_BOXES = 4;
    const CATEGORY_MATCH_CENTER = 5;
    const CATEGORY_TOURNAMENTS = 6;

    public static function labels()
    {
        return [
            self::CATEGORY_GENERAL => 'Общие',
            self::CATEGORY_BOOKMAKERS => 'Букмекеры',
            self::CATEGORY_CASINOS => 'Рулетки',
            self::CATEGORY_LOOT_BOXES => 'Лутбоксы',
            self::CATEGORY_MATCH_CENTER => 'Матчи',
            self::CATEGORY_TOURNAMENTS => 'Турниры',
        ];
    }
}
