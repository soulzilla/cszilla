<?php

/* @var $model User */
/* @var $profileForm Profile */
/* @var $passwordForm PasswordChangeForm */

use app\forms\PasswordChangeForm;
use app\models\{Profile, User};
use app\widgets\settings\Settings;
use yii\bootstrap4\{ActiveForm, Html};

$this->title = 'Профиль пользователя ' . $model->profile->name;
?>

<div class="row py-3 mw-100 ml-0">
    <section class="blog-list-section col-12 col-lg-6">
        <div class="container pr-3 pr-lg-0 h-100">
            <?= Settings::widget([
                'model' => $model,
                'type' => 'bookmakers',
                'title' => 'Букмекеры',
                'help' => 'Выберите конторы, в которых играете'
            ]) ?>
        </div>
    </section>

    <section class="blog-list-section col-12 col-lg-6 pt-3 pt-lg-0">
        <div class="container pl-3 pl-lg-0 h-100">
            <?= Settings::widget([
                'model' => $model,
                'type' => 'casinos',
                'title' => 'Казино',
                'help' => 'Выберите казино, в которых играете'
            ]) ?>
        </div>
    </section>
</div>

<div class="row pb-3 mw-100 ml-0">
    <section class="blog-list-section col-12 col-lg-6">
        <div class="container pr-3 pr-lg-0 h-100">
            <?= Settings::widget([
                'model' => $model,
                'type' => 'loot-boxes',
                'title' => 'Лутбоксы',
                'help' => 'Выберите сайты, в которых играете'
            ]) ?>
        </div>
    </section>

    <section class="blog-list-section col-12 col-lg-6 pt-3 pt-lg-0">
        <div class="container pl-3 pl-lg-0 h-100">
            <?= Settings::widget([
                'model' => $model,
                'type' => 'categories',
                'title' => 'Разделы публикаций',
                'help' => 'Выберите разделы, которые Вам интересны'
            ]) ?>
        </div>
    </section>
</div>

<div class="row pb-3 mw-100 ml-0">
    <section class="blog-list-section col-12 col-lg-6">
        <div class="container pr-3 pr-lg-0 h-100">
            <div class="bordered-box h-100">
                <h2 class="text-white mb-3">Настройки</h2>
                <div class="comment-form">
                    <?php $profileActiveForm = ActiveForm::begin() ?>

                    <?= $profileActiveForm->field($profileForm, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Никнейм'])->label(false) ?>

                    <?= $profileActiveForm->field($profileForm, 'steam_url')->textInput(['maxlength' => true, 'type' => 'url', 'placeholder' => 'Профиль Steam'])->label(false) ?>

                    <?= $profileActiveForm->field($profileForm, 'vk_url')->textInput(['maxlength' => true, 'type' => 'url', 'placeholder' => 'Профиль VK'])->label(false) ?>

                    <?= $profileActiveForm->field($profileForm, 'about')->textarea(['placeholder' => 'Расскажите о себе'])->label(false) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Сохранить', ['class' => 'site-btn', 'name' => 'auth-button']) ?>
                    </div>

                    <?php $profileActiveForm::end() ?>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-list-section col-12 col-lg-6 pt-3 pt-lg-0">
        <div class="container pl-3 pl-lg-0 h-100">
            <div class="bordered-box h-100">
                <h2 class="text-white mb-3">Безопасность</h2>
                <div class="comment-form">
                    <?php $passwordActiveForm = ActiveForm::begin([
                        'id' => 'password-form',
                        'enableAjaxValidation' => true,
                        'validationUrl' => '/main/validate/password'
                    ]) ?>

                    <?= $passwordActiveForm->field($passwordForm, 'current')->passwordInput(['placeholder' => 'Текущий пароль'])->label(false) ?>

                    <?= $passwordActiveForm->field($passwordForm, 'new_password')->passwordInput(['placeholder' => 'Новый пароль'])->label(false) ?>

                    <?= $passwordActiveForm->field($passwordForm, 'confirm_password')->passwordInput(['placeholder' => 'Повторите новый пароль'])->label(false) ?>

                    <div class="form-group">
                        <?= Html::submitButton('Сохранить', ['class' => 'site-btn', 'name' => 'auth-button']) ?>
                    </div>

                    <?php $passwordActiveForm::end() ?>
                </div>
            </div>
        </div>
    </section>
</div>
