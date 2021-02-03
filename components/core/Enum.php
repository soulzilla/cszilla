<?php

namespace app\components\core;

/**
 * Класс для перечисления используемых констант
 * Class Enum
 * @package app\components\core
 */
abstract class Enum
{
    /**
     * Перечисление констант в формате ключ = значение
     * @return array|string[]
     */
    public static function labels()
    {
        return [];
    }

    /**
     * Возвращает лэйбл по ключу
     * @param $key
     * @return string
     */
    public static function label($key)
    {
        return static::labels()[$key];
    }

    /**
     * Возвращает константы класса
     * @return array|int[]
     */
    public static function keys()
    {
        return array_flip(static::labels());
    }

    /**
     * Возвращает ключ по лэйблу
     * @param $label
     * @return int
     */
    public static function key($label)
    {
        return static::keys()[$label];
    }
}