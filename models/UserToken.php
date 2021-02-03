<?php

namespace app\models;

use app\components\core\ActiveRecord;
use app\enums\YesOrNoEnum;

/**
 * Class UserToken
 * @package app\models
 * @property int $id
 * @property int $user_id
 * @property int $type
 * @property string $token
 * @property string $expire_ts
 * @property int $is_used
 * @property string $ts
 * @property User $user
 */
class UserToken extends ActiveRecord
{
    public static function tableName()
    {
        return 'user_tokens';
    }

    public function rules()
    {
        return [
            [['user_id', 'type', 'token', 'expire_ts', 'is_used'], 'required'],
            [['user_id'], 'exist', 'targetClass' => User::class, 'targetAttribute' => 'id'],
            [['token'], 'unique'],
            [['is_used'], 'in', 'range' => YesOrNoEnum::keys()]
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * Проверка токена на срок действия
     * @return bool
     */
    public function isExpired()
    {
        return time() > strtotime($this->expire_ts);
    }
}
