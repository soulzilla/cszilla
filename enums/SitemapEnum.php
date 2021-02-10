<?php

namespace app\enums;

use app\components\core\Enum;

class SitemapEnum extends Enum
{
    const NEWS_URL = '/news';
    const BOOKMAKERS_URL = '/bookmakers';
    const CASINOS_URL = '/casinos';
    const LOOT_BOXES_URL = '/loot-boxes';
    const CONTESTS_URL = '/giveaways';
    const MATCHES_URL = '/match-center';

    public static function labels()
    {
        return [
            self::NEWS_URL => 'news',
            self::BOOKMAKERS_URL => 'bookmakers',
            self::CASINOS_URL => 'casinos',
            self::LOOT_BOXES_URL => 'loot-boxes',
            self::CONTESTS_URL => 'contests',
            self::MATCHES_URL => 'match-center',
        ];
    }
}
