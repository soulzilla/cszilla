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
            ['name', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u', 'message' => 'Логин может содержать только латинские буквы, цифры и _'],
            ['password', 'match', 'pattern' => '/^[A-Za-z0-9_]+$/u', 'message' => 'Пароль может содержать только латинские буквы, цифры и _'],
            ['name', 'string', 'min' => 6, 'max' => 15],
            ['password', 'string', 'min' => 5],
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
