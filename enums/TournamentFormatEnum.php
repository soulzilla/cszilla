<?php

namespace app\enums;

use app\components\core\Enum;

class TournamentFormatEnum extends Enum
{
    const FORMAT_1V1 = 1;
    const FORMAT_2V2 = 2;
    const FORMAT_5V5 = 3;

    public static function labels()
    {
        return [
            self::FORMAT_1V1 => 'Дуэли',
            self::FORMAT_2V2 => 'Напарники',
            self::FORMAT_5V5 => 'Соревновательные',
        ];
    }

    public static function icons()
    {
        return [
            self::FORMAT_1V1 => 'ion-person',
            self::FORMAT_2V2 => 'ion-person-stalker',
            self::FORMAT_5V5 => 'fa fa-users',
        ];
    }

    public static function icon($key)
    {
        return self::icons()[$key];
    }
}