<?php

use kartik\datetime\DateTimePicker;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Contest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="contest-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date_start')->widget(DateTimePicker::class) ?>

    <?= $form->field($model, 'date_end')->widget(DateTimePicker::class) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::class, [
        'editorOptions' => [
            'preset' => 'full'
        ]
    ]) ?>

    <?= $form->field($model, 'is_published')->checkbox() ?>

    <?= $form->field($model, 'winners_count')->textInput(['type' => 'number']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
