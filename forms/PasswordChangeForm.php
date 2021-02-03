<?php

namespace app\forms;

use app\models\User;
use Yii;
use yii\base\Model;
use yii\web\IdentityInterface;

class PasswordChangeForm extends Model
{
    public $current;

    public $new_password;

    public $confirm_password;

    public function rules()
    {
        return [
            [['current', 'new_password', 'confirm_password'], 'required', 'message' => ''],
            [['current', 'new_password', 'confirm_password'], 'string'],
            [['current', 'new_password', 'confirm_password'],
                'match', 'pattern' => '/^[A-Za-z0-9_]+$/u',
                'message' => 'Пароль может содержать только латинские буквы, цифры и _'
            ],
            ['current', 'validatePassword'],
            ['confirm_password', 'compare', 'compareAttribute' => 'new_password', 'message' => 'Пароли не совпадают']
        ];
    }

    public function validatePassword()
    {
        $user = $this->getUser();
        if (!$user->validatePassword($this->current)) {
            $this->addError('current', 'Неверный пароль');
        }
    }

    /**
     * @return IdentityInterface|User
     */
    public function getUser()
    {
        return Yii::$app->user->identity;
    }
}
