<?php

namespace app\enums;

use app\components\core\Enum;

class TokensEnum extends Enum
{
    const AUTH_TOKEN_TYPE = 1101;
    const EMAIL_VALIDATION_TOKEN = 1102;
    const RESET_PASSWORD_TOKEN = 1103;

    public static function labels()
    {
        return [
            self::AUTH_TOKEN_TYPE => 'Токен авторизации',
            self::EMAIL_VALIDATION_TOKEN => 'Токен валидации почты',
            self::RESET_PASSWORD_TOKEN => 'Токен сброса пароля'
        ];
    }
}