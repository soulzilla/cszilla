<?php

namespace app\enums;

use app\components\core\Enum;

class StagesEnum extends Enum
{
    const STAGE_FINAL = 1;
    const STAGE_SEMIFINAL = 2;
    const STAGE_QUARTERFINAL = 3;
    const STAGE_ONE_EIGHT = 4;

    public static function labels()
    {
        return [
            self::STAGE_FINAL => 'Финал',
            self::STAGE_SEMIFINAL => 'Полуфинал',
            self::STAGE_QUARTERFINAL => 'Четвертьфинал',
            self::STAGE_ONE_EIGHT => 'Одна восьмая',
        ];
    }
}
