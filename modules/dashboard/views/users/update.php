<?php

/* @var $model User */

use app\models\User;
use unclead\multipleinput\MultipleInput;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Json;
use yii\helpers\Url;

$this->title = 'Модерация учетной записи пользователя ' . $model->name;
$model->roles = Json::decode($model->roles);
?>

<div class="users-update-form">
    <?php $activeForm = ActiveForm::begin(); ?>

    <?= $activeForm->field($model, 'roles')->widget(MultipleInput::class, [
        'min' => 1,
        'allowEmptyList' => false,
        'enableGuessTitle' => true,
        'addButtonPosition' => MultipleInput::POS_FOOTER,
    ])->label(false) ?>

    <div class="form-group">
        <button class="btn btn-success" type="submit">Сохранить</button>
        <a class="btn btn-danger" href="<?= Url::to(['/dashboard/users/index']) ?>">Назад</a>
    </div>

    <?php $activeForm::end(); ?>
</div>
