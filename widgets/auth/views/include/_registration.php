<?php

use app\forms\RegistrationForm;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */
/* @var $form ActiveForm */
/* @var $model RegistrationForm */
?>

<?php $form = ActiveForm::begin([
    'options' => [
        'method' => 'post'
    ],
    'enableAjaxValidation' => true,
    'validationUrl' => '/main/validate/registration',
    'action' => Url::to(['/main/registration'])
]); ?>

<?= $form->field($model, 'name')->textInput(['placeholder' => 'Логин', 'maxlength' => true])->label(false) ?>

<?= $form->field($model, 'email')->textInput(['placeholder' => 'Почта', 'type' => 'email'])->label(false) ?>

<?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароль'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Регистрация', ['class' => 'nk-btn nk-btn-rounded nk-btn-color-white nk-btn-block', 'name' => 'registration-button']) ?>
    </div>

<?php ActiveForm::end(); ?>