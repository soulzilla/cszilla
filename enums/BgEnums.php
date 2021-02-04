<?php

namespace app\enums;

use app\components\core\Enum;

class BgEnums extends Enum
{
    const BG_1 = 'bg-main-1';
    const BG_2 = 'bg-main-2';
    const BG_3 = 'bg-main-3';
    const BG_4 = 'bg-main-4';
    const BG_5 = 'bg-main-5';
    const BG_6 = 'bg-main-6';

    public static function labels()
    {
        return [
            self::BG_1 => 'Красный',
            self::BG_2 => 'Фиолетовый',
            self::BG_3 => 'Зелёный',
            self::BG_4 => 'Бирюзовый',
            self::BG_5 => 'Синий',
            self::BG_6 => 'Оранжевый',
        ];
    }
}
