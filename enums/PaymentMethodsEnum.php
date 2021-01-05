<?php

namespace app\enums;

use app\components\core\Enum;

class PaymentMethodsEnum extends Enum
{
    const METHOD_QIWI = 'qiwi';
    const METHOD_YANDEX_MONEY = 'yandex_money';
    const METHOD_WEBMONEY = 'webmoney';
    const METHOD_CREDIT_CARD = 'credit_card';

    public static function labels()
    {
        return [
            self::METHOD_QIWI => 'Qiwi-кошелёк',
            self::METHOD_YANDEX_MONEY => 'Яндекс-кошелёк',
            self::METHOD_WEBMONEY => 'Webmoney',
            self::METHOD_CREDIT_CARD => 'Кредитная карта',
        ];
    }

    public static function icons()
    {
        return [
            self::METHOD_QIWI => 'Qiwi-кошелёк',
            self::METHOD_YANDEX_MONEY => 'Яндекс-кошелёк',
            self::METHOD_WEBMONEY => 'Webmoney',
            self::METHOD_CREDIT_CARD => 'Кредитная карта',
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
}