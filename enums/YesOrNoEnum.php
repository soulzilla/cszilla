<?php

namespace app\enums;

use app\components\core\Enum;

class YesOrNoEnum extends Enum
{
    const STATE_NO = 0;
    const STATE_YES = 1;

    public static function labels()
    {
        return [
            self::STATE_NO => 'Нет',
            self::STATE_YES => 'Да'
        ];
    }
}
