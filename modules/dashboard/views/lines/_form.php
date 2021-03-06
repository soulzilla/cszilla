<?php

use app\components\helpers\ArrayHelper;
use app\models\Bookmaker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\BetLine */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bet-line-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'bookmaker_id')->dropDownList(ArrayHelper::map(Bookmaker::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'order')->textInput(['type' => 'number']) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
