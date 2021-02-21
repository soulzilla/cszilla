<?php

namespace app\enums;

use app\components\core\Enum;

class RolesEnum extends Enum
{
    /**
     * Роль эмулятора
     */
    const ROLE_EMULATED = 10000;
    /**
     * Роль обычного юзера
     */
    const ROLE_USER = 10001;
    /**
     * Роль обычного админа, нужна для доступа в админку
     */
    const ROLE_ADMIN = 10111;
    /**
     * Роль суперадмина
     */
    const ROLE_SUPER_ADMIN = 11111;
    /**
     * Роль модератора
     */
    const ROLE_MODERATOR = 10011;
    /**
     * Роль для доступа в раздел админки с пользователями
     */
    const ROLE_SPECIAL_USERS = 10012;
    /**
     * Роль редактора
     */
    const ROLE_EDITOR = 10013;

    /**
     * @return array|string[]
     */
    public static function labels()
    {
        return [
            self::ROLE_USER => 'ROLE_USER',
            self::ROLE_ADMIN => 'ROLE_ADMIN',
            self::ROLE_SUPER_ADMIN => 'ROLE_SUPER_ADMIN',
            self::ROLE_MODERATOR => 'ROLE_MODERATOR',
            self::ROLE_SPECIAL_USERS => 'ROLE_SPECIAL_USERS',
            self::ROLE_EDITOR => 'ROLE_EDITOR',
            self::ROLE_EMULATED => 'ROLE_EMULATED'
        ];
    }
}
