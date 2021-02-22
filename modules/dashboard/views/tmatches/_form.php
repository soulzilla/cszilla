<?php

use app\components\helpers\Url;
use app\enums\StagesEnum;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TournamentMatch */
/* @var $form yii\widgets\ActiveForm */
$teams = Yii::$app->tournamentsService->getCompetitors($model->tournament_id);
$url = Url::to(['/dashboard/tournaments/teams', 'id' => $model->tournament_id]);
?>

<div class="tournament-match-form">

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

    <?= $form->field($model, 'stage')->dropDownList(StagesEnum::labels()) ?>

    <?= $form->field($model, 'score_first')->textInput() ?>

    <?= $form->field($model, 'score_second')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
