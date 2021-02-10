<?php

namespace app\models;

use app\components\core\ActiveRecord;
use app\enums\{RolesEnum, TokensEnum};
use Yii;
use yii\base\NotSupportedException;
use yii\helpers\Json;
use yii\web\IdentityInterface;

/**
 * Class User
 * @package app\models
 * @property int $id
 * @property string $name
 * @property string $password_hash
 * @property string $email
 * @property int $email_confirmed
 * @property string|array $roles
 * @property string $ts
 * @property string $hash
 * @property int $is_deleted
 * @property int $is_blocked
 *
 * @property UserToken $authToken
 * @property OnlineUser $online
 * @property Profile $profile
 * @property Observer[] $observers
 * @property Wallet $wallet
 */
class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'users';
    }

    public function rules()
    {
        return [
            [['is_deleted', 'is_blocked', 'email_confirmed'], 'integer'],
            ['roles', 'validateRoles'],
            ['password_hash', 'string']
        ];
    }

    public function jsonAttributes()
    {
        return ['roles'];
    }

    /**
     * @param int|string $id
     * @return User|IdentityInterface|null
     * @throws \Throwable
     */
    public static function findIdentity($id)
    {
        /* @var $user User */
        $user = self::find()
            ->where([
                'users.id' => $id
            ])
            ->joinWith([
                'authToken',
                'profile',
                'observers',
                'wallet'
            ])
            ->one();

        //$user->online->renew();
        return $user;
    }

    /**
     * @param mixed $token
     * @param null $type
     * @return void|IdentityInterface|null
     * @throws NotSupportedException
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return UserToken
     */
    public function getAuthKey()
    {
        return $this->authToken;
    }

    /**
     * @param string $authKey
     * @return bool
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    public function getAuthToken()
    {
        return $this->hasOne(UserToken::class, ['user_id' => 'id'])->onCondition(['user_tokens.type' => TokensEnum::AUTH_TOKEN_TYPE]);
    }

    public function getOnline()
    {
        return $this->hasOne(OnlineUser::class, ['user_id' => 'id']);
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['user_id' => 'id']);
    }

    public function getObservers()
    {
        return $this->hasMany(Observer::class, ['user_id' => 'id'])->cache(300);
    }

    public function getWallet()
    {
        return $this->hasOne(Wallet::class, ['user_id' => 'id']);
    }

    /**
     * Проверка пользователя на онлайн
     * @return bool
     */
    public function isOnline()
    {
        return (time() - strtotime($this->online->last_seen)) < 300;
    }

    /**
     * @return array|string[]
     */
    public function getRoles()
    {
        if (is_array($this->roles)) {
            return $this->roles;
        }

        return Json::decode($this->roles);
    }

    public function validateRoles()
    {
        $roles = [];
        foreach ($this->roles as $role) {
            if (!($key = RolesEnum::key($role))) {
                $this->addError('roles', 'Роль не найдена');
                break;
            }
            $roles[$key] = $role;
        }

        if (sizeof($roles)) {
            $this->roles = Json::encode($roles, JSON_UNESCAPED_SLASHES);
        }
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Логин',
            'email' => 'Почта'
        ];
    }

    public function afterDelete()
    {
        Profile::deleteAll([
            'user_id' => $this->id
        ]);

        Comment::deleteAll([
            'user_id' => $this->id
        ]);

        parent::afterDelete();
    }
}
