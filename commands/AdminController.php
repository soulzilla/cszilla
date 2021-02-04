<?php

namespace app\commands;

use app\enums\RolesEnum;
use app\forms\RegistrationForm;
use yii\console\Controller;

class AdminController extends Controller
{
    /**
     */
    public function actionIndex()
    {
        $form = new RegistrationForm();
        $form->name = 'csheaven';
        $form->password = 'Yii2IsTheBestFrameWork4Ever';
        $form->email = \Yii::$app->params['adminEmail'];
        $form->roles = [
            RolesEnum::ROLE_USER => 'ROLE_USER',
            RolesEnum::ROLE_ADMIN => 'ROLE_ADMIN',
            RolesEnum::ROLE_SUPER_ADMIN => 'ROLE_SUPER_ADMIN'
        ];
        $form->email_confirmed = 1;

        \Yii::$app->usersService->register($form);

        echo "Admin registered: {$form->name} {$form->password}";
    }
}
