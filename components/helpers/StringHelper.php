<?php

namespace app\components\helpers;

use Yii;
use yii\base\InvalidConfigException;

class StringHelper
{
    /**
     * Транслитерация русских букв в английский
     * @param string $text
     * @return string
     */
    public static function transliterate(string $text): string
    {
        $text = transliterator_transliterate("Any-Latin; NFD; [:Nonspacing Mark:] Remove; NFC; Lower();", $text);
        $text = preg_replace ('/[^\p{L}\p{N}\s]/u', '', $text);
        $text = str_replace("ʹ", '', $text);
        $text = preg_replace('/[-\s]+/', '-', $text);
        return trim($text, '-');
    }

    /**
     * Получаем soundex текста
     * @param string $text
     * @return string
     */
    public static function soundEx(string $text): string
    {
        $text = self::transliterate($text);
        $textArray = explode(' ', $text);

        if (!sizeof($textArray)) {
            return soundex($text);
        }

        foreach ($textArray as &$word) {
            $word = soundex($word);
        }

        return implode(' ', $textArray);
    }

    /**
     * Получаем фонему текста
     * @param string $text
     * @return false|string
     */
    public static function phoneme(string $text)
    {
        $text = self::transliterate($text);
        $textArray = explode(' ', $text);

        if (!sizeof($textArray)) {
            return metaphone($text);
        }

        foreach ($textArray as &$word) {
            $word = metaphone($word);
        }

        return implode(' ', $textArray);
    }

    /**
     * Создаём триграммный текст
     * @param string $text
     * @return string
     */
    public static function trigram(string $text): string
    {
        $textArray = explode(' ', $text);

        if (!sizeof($textArray)) {
            return mb_strimwidth($text, 0, 3, '', Yii::$app->params['encode']);
        }

        foreach ($textArray as &$word) {
            $word = mb_strimwidth($word, 0, 3, '', Yii::$app->params['encode']);
        }

        return implode(' ', $textArray);
    }

    /**
     * @param string $string
     * @param bool $capitalizeFirstCharacter
     * @return string|string[]
     */
    public static function underscoreToCamelCase(string $string, $capitalizeFirstCharacter = false)
    {
        $str = str_replace('_', '', ucwords($string, '_'));

        if (!$capitalizeFirstCharacter) {
            $str = lcfirst($str);
        }

        return $str;
    }

    /**
     * @param $timestamp
     * @param bool $full
     * @param bool $withTime
     * @return string
     * @throws InvalidConfigException
     */
    public static function humanize($timestamp, $full = false, $withTime = true): string
    {
        $time = strtotime($timestamp);

        $diff = time() - $time;
        if ($diff < 60*60 && !$full) {
            return Yii::$app->formatter->asRelativeTime($time);
        }

        if (!$withTime) {
            return Yii::$app->formatter->asDate($time);
        }

        return Yii::$app->formatter->asDatetime($time, 'short');
    }

    public static function getDefaultKeywords(): string
    {
        return 'cs, csgo, cs go, cs go skins, csgo news, cs go news, csgo skins, скины ксго, кс скины, контр страйк, ксго, контра, розыгрыши, раздача скинов, халява, бонусы, промокоды';
    }

    public static function getDefaultDescription(): string
    {
        return 'CSZilla - лучший сайт по игре Counter-Strike: Global Offensive';
    }
}
