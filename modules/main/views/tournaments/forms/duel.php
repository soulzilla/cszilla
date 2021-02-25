<?php

/** @var $model app\forms\tournament\RegisterDuelForm */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$form = ActiveForm::begin([
    'enableAjaxValidation' => true,
    'validationUrl' => '/main/validate/duel'
]);
?>

    <?= $form->field($model, 'tournament_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'user_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'steam_url')->textInput(['placeholder' => 'Steam профиль'])->label(false) ?>

    <?= $form->field($model, 'faceit_url')->textInput(['placeholder' => 'FACEIT профиль'])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Подтвердить', ['class' => 'nk-btn nk-btn-rounded nk-btn-color-white nk-btn-block', 'name' => 'accept-button']) ?>
    </div>

<?php $form::end() ?>

