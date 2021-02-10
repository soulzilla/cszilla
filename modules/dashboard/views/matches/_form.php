<?php

use app\components\helpers\ArrayHelper;
use app\models\Team;
use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GameMatch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="game-match-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_team')->dropDownList(ArrayHelper::map(Team::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'second_team')->dropDownList(ArrayHelper::map(Team::find()->all(), 'id', 'name')) ?>

    <?= $form->field($model, 'is_finished')->checkbox() ?>

    <?= $model->id ? $form->field($model, 'winner_team')->dropDownList([
        0 => '',
        $model->first_team => $model->firstTeam->name,
        $model->second_team => $model->secondTeam->name
    ]) : '' ?>

    <?= $form->field($model, 'start_ts')->widget(DateTimePicker::class) ?>

    <?= $form->field($model, 'final_score')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
