<?php

use app\forms\AuthForm;
use app\forms\RegistrationForm;
use yii\bootstrap4\Modal;
use yii\bootstrap4\Tabs;
use yii\web\View;

/* @var $this View */
/* @var $authModel AuthForm */
/* @var $registrationModel RegistrationForm */

Modal::begin([
    'id' => 'auth-modal',
    'title' => 'Войти'
]);
?>

<div>
    <?= Tabs::widget([
        'items' => [
            [
                'label' => 'Авторизация',
                'content' => $this->render('include/_auth', ['model' => $authModel]),
                'active' => true
            ],
            [
                'label' => 'Регистрация',
                'content' => $this->render('include/_registration', ['model' => $registrationModel])
            ],
        ]
    ]) ?>
</div>

<?php Modal::end(); ?>
