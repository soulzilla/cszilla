<?php

use app\components\helpers\ArrayHelper;
use app\components\helpers\Url;
use app\models\Team;
use kartik\datetime\DateTimePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GameMatch */
/* @var $form yii\widgets\ActiveForm */
$teams = ArrayHelper::map(Team::find()->cache(300)->all(), 'id', 'name');
$url = Url::to(['teams']);
?>

<div class="game-match-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_team')->widget(Select2::class, [
        'data' => $teams,
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

    <?= $form->field($model, 'second_team')->widget(Select2::class, [
        'data' => $teams,
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
