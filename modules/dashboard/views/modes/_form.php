<?php

use app\components\helpers\ArrayHelper;
use app\models\Casino;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GameMode */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="game-mode-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'casino_id')->dropDownList(ArrayHelper::map(Casino::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
