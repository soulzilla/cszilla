<?php

use app\widgets\file\FileUpload;
use mihaildev\ckeditor\CKEditor;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Banner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="banner-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'content')->widget(CKEditor::class, [
        'editorOptions' => [
            'preset' => 'full'
        ]
    ]) ?>

    <?= FileUpload::widget([
        'model' => $model,
        'attribute' => 'background_image'
    ]) ?>

    <?= $form->field($model, 'url')->textInput(['type' => 'url']) ?>

    <?= $form->field($model, 'order')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'is_published')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
