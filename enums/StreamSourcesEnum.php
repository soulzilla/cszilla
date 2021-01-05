<?php

namespace app\enums;

use app\components\core\Enum;

class StreamSourcesEnum extends Enum
{
    const SOURCE_TWITCH = 1;
    const SOURCE_YOUTUBE = 2;
    const SOURCE_INSTAGRAM = 3;

    public static function labels()
    {
        return [
            self::SOURCE_TWITCH => 'Twitch',
            self::SOURCE_YOUTUBE => 'YouTube',
            self::SOURCE_INSTAGRAM => 'Instagram',
        ];
    }
}