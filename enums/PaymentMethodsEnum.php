<?php

namespace app\enums;

use app\components\core\Enum;

class PaymentMethodsEnum extends Enum
{
    const METHOD_ONLINE_WALLET = 'online_wallet';
    const METHOD_MOBILE_PHONE = 'mobile_phone';
    const METHOD_SKINS_PAY = 'skins_pay';
    const METHOD_CREDIT_CARD = 'credit_card';

    public static function labels()
    {
        return [
            self::METHOD_ONLINE_WALLET => 'Электронные кошельки',
            self::METHOD_SKINS_PAY => 'Оплата скинами',
            self::METHOD_MOBILE_PHONE => 'С баланса телефона',
            self::METHOD_CREDIT_CARD => 'Кредитная карта',
        ];
    }

    public static function icons()
    {
        return [
            self::METHOD_ONLINE_WALLET => 'Электронные кошельки',
            self::METHOD_SKINS_PAY => 'Оплата скинами',
            self::METHOD_MOBILE_PHONE => 'С баланса телефона',
            self::METHOD_CREDIT_CARD => 'Кредитная карта',
        ];
    }

    public static function icon($keys)
    {
        $textIcons = '';
        $icons = static::icons();
        foreach ($keys as $key) {
            $textIcons .= isset($icons[$key]) ? $icons[$key] : '';
        }

        return $textIcons;
    }
    public static function fonts()
    {
        return [
            self::METHOD_ONLINE_WALLET => '<img src="/icons/wallet.svg" width="17">',
            self::METHOD_SKINS_PAY => '<img src="/icons/skinpay.svg" width="17">',
            self::METHOD_MOBILE_PHONE => '<img src="/icons/phone.svg" width="17">',
            self::METHOD_CREDIT_CARD => '<img src="/icons/credit-card.svg" width="17">',
        ];
    }

    public static function font($key)
    {
        return isset(static::fonts()[$key]) ? static::fonts()[$key] : '';
    }
}