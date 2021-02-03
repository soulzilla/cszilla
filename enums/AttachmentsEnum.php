<?php

namespace app\enums;

use app\components\core\Enum;

class AttachmentsEnum extends Enum
{
    const TYPE_IMAGE = 1;
    const TYPE_VIDEO = 2;

    public static function labels()
    {
        return [
            self::TYPE_IMAGE => 'Картинка',
            self::TYPE_VIDEO => 'Видео'
        ];
    }
}
