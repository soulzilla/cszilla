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

<div class="comment-form mt-3">
    <?php $form = ActiveForm::begin([
        'options' => [
            'method' => 'post'
        ],
        'enableAjaxValidation' => true,
        'action' => Url::to(['/main/default/auth'])
    ]); ?>

    <?= $form->field($model, 'username')->textInput(['placeholder' => 'Логин'])->label(false) ?>

    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароль'])->label(false) ?>

    <?= $form->field($model, 'rememberMe')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'auth-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
