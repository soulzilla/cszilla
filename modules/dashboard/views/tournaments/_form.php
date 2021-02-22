<?php

use app\components\helpers\Url;
use app\enums\TournamentFormatEnum;
use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Tournament */
/* @var $form yii\widgets\ActiveForm */

$url = Url::to(['/dashboard/tournaments/teams', 'id' => $model->id]);
?>

<div class="tournament-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'format')->dropDownList(TournamentFormatEnum::labels()) ?>

    <?= $form->field($model, 'regulations')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'competitors_limit')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'prize_pool')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'serial_number')->textInput() ?>

    <?= $form->field($model, 'date_start')->widget(DateTimePicker::class) ?>

    <?= $form->field($model, 'twitch_stream')->textInput(['type' => 'url']) ?>

    <?= $form->field($model, 'show_stream')->checkbox() ?>

    <?= $form->field($model, 'is_published')->checkbox() ?>

    <?php if ($model->id): ?>
        <?= $form->field($model, 'is_finished')->checkbox() ?>

        <?= $form->field($model, 'winner')->widget(Select2::class, [
            'data' => [],
            'language' => 'ru',
            'options' => ['placeholder' => 'Выберите команду ...'],
            'pluginOptions' => [
                'allowClear' => true,
                'ajax' => [
                    'url' => $url,
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                ],
            ],
        ]); ?>
    <?php endif; ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
