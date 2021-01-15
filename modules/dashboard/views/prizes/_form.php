<?php

use app\widgets\file\FileUpload;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Prize */
/* @var $form yii\widgets\ActiveForm */

$contest_id = (int) Yii::$app->request->get('contest_id');
?>

<div class="prize-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'contest_id')->hiddenInput(['value' => $contest_id])->label(false) ?>

    <?= FileUpload::widget([
        'model' => $model,
        'attribute' => 'image'
    ]) ?>

    <?= $form->field($model, 'order')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'sent')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
