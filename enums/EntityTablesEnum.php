<?php

namespace app\enums;

use app\components\core\Enum;

class EntityTablesEnum extends Enum
{
    const TABLE_BOOKMAKERS = 'bookmakers';
    const TABLE_CASINOS = 'casinos';
    const TABLE_LOOT_BOXES = 'loot_boxes';

    public static function labels()
    {
        return [
            self::TABLE_BOOKMAKERS => 'Букмекеры',
            self::TABLE_CASINOS => 'Казино',
            self::TABLE_LOOT_BOXES => 'Лутбоксы',
        ];
    }
}