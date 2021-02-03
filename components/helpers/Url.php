<?php

namespace app\components\helpers;

class Url extends \yii\helpers\Url
{
    public static function redirect(string $url)
    {
        return static::to(['/main/default/redirect', 'url' => $url]);
    }

    /**
     * @param $url
     * @return array|false|int|string|null
     */
    public static function parse($url)
    {
        $protocol = substr($url, 0, 5);
        if ($protocol !== 'https') {
            return [$url];
        }

        return parse_url($url);
    }
}
