<?php

use kartik\datetime\DateTimePicker;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Publication */
/* @var $form yii\widgets\ActiveForm */
/* @var $categories string[] */
?>

<div class="publication-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->dropDownList($categories) ?>

    <?= $form->field($model, 'publish_date')->widget(DateTimePicker::class) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_canonical')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'announce')->textarea() ?>

    <?= $form->field($model, 'body')->widget(CKEditor::class, [
        'editorOptions' => [
            'preset' => 'full'
        ],
    ]) ?>

    <?= $form->field($model, 'is_published')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
