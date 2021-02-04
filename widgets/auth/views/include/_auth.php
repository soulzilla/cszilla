<?php

use app\forms\AuthForm;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */
/* @var $form ActiveForm */
/* @var $model AuthForm */
?>

<?php $form = ActiveForm::begin([
    'options' => [
        'method' => 'post'
    ],
    'enableAjaxValidation' => true,
    'validationUrl' => '/main/validate/auth',
    'action' => Url::to(['/main/default/auth'])
]); ?>

<?= $form->field($model, 'username')->textInput(['placeholder' => 'Логин'])->label(false) ?>

<?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароль'])->label(false) ?>

<?= $form->field($model, 'rememberMe')->checkbox() ?>

<div class="form-group">
    <?= Html::submitButton('Войти', ['class' => 'nk-btn nk-btn-rounded nk-btn-color-white nk-btn-block', 'name' => 'auth-button']) ?>
</div>

<?php ActiveForm::end(); ?>
