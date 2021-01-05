<?php

namespace app\enums;

use app\components\core\Enum;

class CurrenciesEnum extends Enum
{
    const CURRENCY_TENGE = 7373;
    const CURRENCY_RUBLE = 7374;
    const CURRENCY_DOLLAR = 7375;
    const CURRENCY_EURO = 7376;
    const CURRENCY_BITCOIN = 7377;

    public static function labels()
    {
        return [
            self::CURRENCY_TENGE => 'Тенге',
            self::CURRENCY_RUBLE => 'Рубль',
            self::CURRENCY_DOLLAR => 'Доллар',
            self::CURRENCY_EURO => 'Евро',
            self::CURRENCY_BITCOIN => 'Биткоин'
        ];
    }

    public static function icons()
    {
        return [
            self::CURRENCY_TENGE => '<span><i class="fa fa-tenge"></i></span>',
            self::CURRENCY_RUBLE => '<span><i class="fa fa-ruble"></i></span>',
            self::CURRENCY_DOLLAR => '<span><i class="fa fa-dollar"></i></span>',
            self::CURRENCY_EURO => '<span><i class="fa fa-euro"></i></span>',
            self::CURRENCY_BITCOIN => '<span><i class="fa fa-bitcoin"></i></span>'
        ];
    }

    public static function icon($keys)
    {
        $textIcons = '';
        $icons = static::icons();
        foreach ($keys as $key) {
            $textIcons .= $icons[$key];
        }

        return $textIcons;
    }

    public static function fonts()
    {
        return [
            self::CURRENCY_TENGE => '&#8376;',
            self::CURRENCY_RUBLE => '&#8381;',
            self::CURRENCY_DOLLAR => '&#36;',
            self::CURRENCY_EURO => '&euro;',
            self::CURRENCY_BITCOIN => '&#8383;'
        ];
    }

    public static function font($key)
    {
        return static::fonts()[$key];
    }
}
