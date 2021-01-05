<?php

/* @var $this yii\web\View */

use app\models\Boxes;
use app\models\LootBox;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/* @var $model Boxes */
/* @var $site LootBox */

$this->title = 'Кейсы сайта ' . $site->name;
?>

<div class="boxes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'military_cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'military_average')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'restricted_cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'restricted_average')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'classified_cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'classified_average')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'covert_cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'covert_average')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'knife_cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'knife_average')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gloves_cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gloves_average')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ak_cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ak_average')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'awp_cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'awp_average')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deagle_cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'deagle_average')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'glock_cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'glock_average')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'm4a1_cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'm4a1_average')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usp_cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usp_average')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'm4a4_cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'm4a4_average')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'top_cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'top_average')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
