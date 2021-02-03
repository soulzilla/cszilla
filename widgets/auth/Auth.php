<?php

namespace app\widgets\auth;

use app\forms\AuthForm;
use app\forms\RegistrationForm;
use yii\bootstrap4\Widget;

class Auth extends Widget
{
    public function run()
    {
        $authModel = new AuthForm();
        $registrationModel = new RegistrationForm();

        return $this->render('index', [
            'authModel' => $authModel,
            'registrationModel' => $registrationModel
        ]);
    }
}
