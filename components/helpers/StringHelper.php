<?php

namespace app\components\helpers;

class StringHelper
{
    /**
     * Транслитерация русских букв в английский
     * @param string $text
     * @return string
     */
    public static function transliterate(string $text)
    {
        $text = transliterator_transliterate("Any-Latin; NFD; [:Nonspacing Mark:] Remove; NFC; Lower();", $text);
        $text = preg_replace('/[-\s]+/', '-', $text);
        return trim($text, '-');
    }

    /**
     * Получаем soundex текста
     * @param string $text
     * @return string
     */
    public static function soundEx(string $text)
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
    public static function trigram(string $text)
    {
        $textArray = explode(' ', $text);

        if (!sizeof($textArray)) {
            return mb_strimwidth($text, 0, 3, '', \Yii::$app->params['encode']);
        }

        foreach ($textArray as &$word) {
            $word = mb_strimwidth($word, 0, 3, '', \Yii::$app->params['encode']);
        }

        return implode(' ', $textArray);
    }

    /**
     * @param string $string
     * @param bool $capitalizeFirstCharacter
     * @return string|string[]
     */
    public static function underscoreToCamelCase($string, $capitalizeFirstCharacter = false)
    {
        $str = str_replace('_', '', ucwords($string, '_'));

        if (!$capitalizeFirstCharacter) {
            $str = lcfirst($str);
        }

        return $str;
    }

    public static function humanize($timestamp)
    {
        $months = [
            1 => 'Январь',
            2 => 'Февраль',
            3 => 'Март',
            4 => 'Апрель',
            5 => 'Май',
            6 => 'Июнь',
            7 => 'Июль',
            8 => 'Август',
            9 => 'Сентябрь',
            10 => 'Октябрь',
            11 => 'Ноябрь',
            12 => 'Декабрь',
        ];
        $time = strtotime($timestamp);
        $day = date('d', $time);
        $month = $months[date('m', $time)];
        $year = date('Y', $time);
        $time = date('H:i', $time);

        return $month . ' ' . $day . ', ' . $year . ' ' . $time;
    }
}
