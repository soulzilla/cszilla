<?php

namespace app\enums;

use app\components\core\Enum;

class BoxesEnum extends Enum
{
    public static function labels()
    {
        return [
            'military' => 'Армейский',
            'restricted' => 'Запрещённый',
            'classified' => 'Засекреченный',
            'covert' => 'Тайный',
            'knife' => 'Ножевой',
            'gloves' => 'Перчаточный',
            'top' => 'Топовый',
            'usp' => 'USP',
            'glock' => 'Glock',
            'deagle' => 'Deagle',
            'ak' => 'AK-47',
            'm4a1' => 'M4A1-S',
            'm4a4' => 'M4A4',
            'awp' => 'AWP'
        ];
    }
}
