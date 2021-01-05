<?php

use app\filters\UsersFilter;
use yii\bootstrap\ActiveForm;

/* @var $filter UsersFilter */
?>

<?php $form = ActiveForm::begin([
    'method' => 'get'
]) ?>

<div class="col-lg-2">
    <?= $form->field($filter, 'id')->textInput(['type' => 'number']) ?>
</div>

<div class="col-lg-5">
    <?= $form->field($filter, 'name')->label('Логин') ?>
</div>

<div class="col-lg-5">
    <?= $form->field($filter, 'email')->label('Email') ?>
</div>

<div class="form-group hidden">
    <button type="submit" class="btn btn-primary">Применить</button>
</div>

<?php $form::end(); ?>
