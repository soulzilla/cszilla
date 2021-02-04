<?php

namespace app\forms;

use app\models\User;
use yii\base\Model;

class AuthForm extends Model
{
    public $username;
    public $password;
    public $rememberMe;

    /** @var User */
    private $_user;

    public function rules()
    {
        return [
            [['username', 'password'], 'string'],
            [['username', 'password'], 'required'],
            [['password'], 'validatePassword']
        ];
    }

    public function validatePassword()
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError('password', 'Неверный логин или пароль');
            }
        }
    }

    public function getUser()
    {
        if (!$this->_user) {
            $this->_user = User::find()->where([
                'name' => $this->username
            ])->one();
        }

        return $this->_user;
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
