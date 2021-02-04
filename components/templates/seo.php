<?php

use app\models\Seo;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;

/* @var $model Seo */
/* @var $form ActiveForm */

$this->title = 'SEO-оптимизация';
?>

<div class="seo-form">
    <?php $form = ActiveForm::begin() ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'keywords')->textInput() ?>

    <?= $form->field($model, 'description')->textInput() ?>

    <?= $form->field($model, 'noindex')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php $form::end() ?>
</div>
