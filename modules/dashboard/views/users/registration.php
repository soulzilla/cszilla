<?php

use app\forms\RegistrationForm;
use unclead\multipleinput\MultipleInput;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */
/* @var $form ActiveForm */
/* @var $model RegistrationForm */

$this->title = 'Зарегистрировать нового пользователя';
?>

<div class="auth-form">
    <?php $form = ActiveForm::begin([
        'options' => [
            'method' => 'post'
        ],
        'action' => Url::to(['/dashboard/users/registration'])
    ]); ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'email_confirmed')->checkbox() ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'roles')->widget(MultipleInput::class, [
        'min' => 1,
        'allowEmptyList' => false,
        'enableGuessTitle' => true,
        'addButtonPosition' => MultipleInput::POS_FOOTER,
    ])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'registration-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
