<?php

namespace app\forms;

use app\models\User;
use yii\base\Model;

class AuthForm extends Model
{
    public $username;
    public $password;
    public $rememberMe;

    public function rules()
    {
        return [
            [['username', 'password'], 'string'],
            [['username', 'password'], 'required'],
            [['username'], 'exist', 'targetClass' => User::class, 'targetAttribute' => 'name']
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'rememberMe' => 'Запомнить меня',
        ];
    }
}
