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

<div class="comment-form mt-3">
    <?php $form = ActiveForm::begin([
        'options' => [
            'method' => 'post'
        ],
        'action' => Url::to(['/main/registration'])
    ]); ?>

    <?= $form->field($model, 'name')->textInput(['placeholder' => 'Логин'])->label(false) ?>

    <?= $form->field($model, 'email')->textInput(['placeholder' => 'Почта', 'type' => 'email'])->label(false) ?>

    <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Пароль'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Регистрация', ['class' => 'btn btn-primary', 'name' => 'registration-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
