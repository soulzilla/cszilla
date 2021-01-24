<?php

namespace app\enums;

use app\components\core\Enum;

class StaticBlockEnum extends Enum
{
    const TYPE_MAIN_DESCRIPTION = 900;
    const TYPE_NEWS_DESCRIPTION = 899;
    const TYPE_TOP = 901;

    const SOCIAL_VK = 1001;
    const SOCIAL_TELEGRAM = 1002;
    const SOCIAL_INSTAGRAM = 1003;
    const SOCIAL_YOUTUBE = 1004;
    const SOCIAL_TWITCH = 1005;
    const SOCIAL_DISCORD = 1006;

    public static function labels()
    {
        return [
            self::TYPE_MAIN_DESCRIPTION => 'Описание в главном экране',
            self::TYPE_NEWS_DESCRIPTION => 'Описание страницы новостей',
            self::TYPE_TOP => 'Топ в виджетах',
            self::SOCIAL_VK => 'Группа ВКонтакте',
            self::SOCIAL_TELEGRAM => 'Telegram',
            self::SOCIAL_INSTAGRAM => 'Instagram',
            self::SOCIAL_YOUTUBE => 'YouTube',
            self::SOCIAL_TWITCH => 'Twitch',
            self::SOCIAL_DISCORD => 'Discord',
        ];
    }
}
