<?php

/* @var $model User */
/* @var $profileForm Profile */

/* @var $passwordForm PasswordChangeForm */

use app\components\helpers\Url;
use app\forms\PasswordChangeForm;
use app\widgets\alert\Alert;
use app\models\{Profile, User};
use app\widgets\settings\Settings;
use yii\bootstrap4\{ActiveForm, Html};

$this->title = 'Профиль пользователя ' . $model->profile->name;
?>

<div class="nk-store nk-store-checkout">

    <div class="nk-gap-2"></div>

    <h3 class="nk-decorated-h-3"><span>Профиль</span></h3>

    <div class="nk-gap"></div>

    <?= Alert::widget() ?>

    <div class="row">
        <?= Settings::widget([
            'model' => $model,
            'type' => 'bookmakers',
            'title' => 'Букмекеры',
            'help' => 'Выберите конторы, в которых играете'
        ]) ?>

        <?= Settings::widget([
            'model' => $model,
            'type' => 'casinos',
            'title' => 'Рулетки',
            'help' => 'Выберите рулетки, в которых играете'
        ]) ?>

        <?= Settings::widget([
            'model' => $model,
            'type' => 'loot_boxes',
            'title' => 'Лутбоксы',
            'help' => 'Выберите сайты, в которых играете'
        ]) ?>

        <?= Settings::widget([
            'model' => $model,
            'type' => 'categories',
            'title' => 'Разделы публикаций',
            'help' => 'Выберите разделы, которые Вам интересны'
        ]) ?>

        <div class="col-lg-6">
            <h3 class="nk-decorated-h-2"><span>Настройки</span></h3>

            <?php $profileActiveForm = ActiveForm::begin() ?>

            <?= $profileActiveForm->field($profileForm, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Никнейм'])->label(false) ?>

            <?= $profileActiveForm->field($profileForm, 'steam_url')->textInput(['maxlength' => true, 'type' => 'url', 'placeholder' => 'Профиль Steam'])->label(false) ?>

            <?= $profileActiveForm->field($profileForm, 'vk_url')->textInput(['maxlength' => true, 'type' => 'url', 'placeholder' => 'Профиль VK'])->label(false) ?>

            <?= $profileActiveForm->field($profileForm, 'about')->textarea(['placeholder' => 'Расскажите о себе', 'rows' => 5, 'class' => 'form-control resize-none'])->label(false) ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'nk-btn nk-btn-rounded nk-btn-color-main-1', 'name' => 'profile-button']) ?>
            </div>

            <?php $profileActiveForm::end() ?>

            <div class="nk-gap"></div>
        </div>

        <div class="col-lg-6">
            <h3 class="nk-decorated-h-2"><span>Безопасность</span></h3>

            <?php $passwordActiveForm = ActiveForm::begin([
                'id' => 'password-form',
                'enableAjaxValidation' => true,
                'validationUrl' => '/main/validate/password'
            ]) ?>

            <?= $passwordActiveForm->field($passwordForm, 'current')->passwordInput(['placeholder' => 'Текущий пароль'])->label(false) ?>

            <?= $passwordActiveForm->field($passwordForm, 'new_password')->passwordInput(['placeholder' => 'Новый пароль'])->label(false) ?>

            <?= $passwordActiveForm->field($passwordForm, 'confirm_password')->passwordInput(['placeholder' => 'Повторите новый пароль'])->label(false) ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'nk-btn nk-btn-rounded nk-btn-color-main-1', 'name' => 'auth-button']) ?>
            </div>

            <?php $passwordActiveForm::end() ?>

            <div class="nk-gap"></div>
        </div>

        <div class="col-lg-6">
            <h3 class="nk-decorated-h-2"><span>Выход</span></h3>
            <a href="<?= Url::to(['/main/default/logout']) ?>" class="nk-btn nk-btn-rounded nk-btn-color-main-1" data-method="post">
                Выйти
            </a>
            <div class="nk-gap-2"></div>
        </div>
    </div>
</div>
