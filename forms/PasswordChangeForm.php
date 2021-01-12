<?php

namespace app\forms;

use app\models\User;
use Yii;
use yii\base\Model;

class PasswordChangeForm extends Model
{
    public $current;

    public $new_password;

    public $confirm_password;

    public function rules()
    {
        return [
            [['current', 'new_password', 'confirm_password'], 'required'],
            [['current', 'new_password', 'confirm_password'], 'string'],
            [['current', 'new_password', 'confirm_password'],
                'match', 'pattern' => '/^[A-Za-z0-9_]+$/u',
                'message' => 'Пароль может содержать только латинские буквы, цифры и _'
            ],
            [['current'], 'validatePassword'],
            ['confirm_password', 'compare', 'compareAttribute' => 'new_password', 'message' => 'Пароли не совпадают']
        ];
    }

    public function validatePassword()
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->current)) {
                $this->addError('password', 'Неверный пароль');
            }
        }
    }

    /**
     * @return \yii\web\IdentityInterface|User
     */
    public function getUser()
    {
        return Yii::$app->user->identity;
    }
}
