<?php

namespace app\forms;

use app\enums\RolesEnum;
use app\models\User;
use yii\base\Model;

class RegistrationForm extends Model
{
    public $name;
    public $password;
    public $email;
    public $roles = [];
    public $email_confirmed = 0;

    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->roles = [
            RolesEnum::ROLE_USER => RolesEnum::label(RolesEnum::ROLE_USER)
        ];
    }

    public function rules()
    {
        return [
            [['name', 'password', 'email'], 'string'],
            [['name', 'password', 'email'], 'required'],
            [['name'], 'unique', 'targetClass' => User::class, 'targetAttribute' => 'name'],
            [['email'], 'unique', 'targetClass' => User::class, 'targetAttribute' => 'email']
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Логин',
            'password' => 'Пароль',
            'roles' => 'Роли',
            'email_confirmed' => 'Почта подтверждена',
        ];
    }
}
