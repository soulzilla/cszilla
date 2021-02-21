<?php

use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ticker */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ticker-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date_start')->widget(DateTimePicker::class) ?>

    <?= $form->field($model, 'date_end')->widget(DateTimePicker::class) ?>

    <?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'url')->textInput(['type' => 'url']) ?>

    <?= $form->field($model, 'target')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
