<?php

use app\components\helpers\Url;
use app\enums\YesOrNoEnum;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $provider yii\data\ActiveDataProvider */
/* @var $filter app\filters\PredictionsFilter */

$this->title = 'Прогнозы';
?>
<div class="game-match-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'method' => 'get'
    ]) ?>

    <div class="col-lg-4">
        <?= $form->field($filter, 'user_id')->widget(Select2::class, [
            'data' => [],
            'language' => 'ru',
            'options' => ['placeholder' => 'Введите имя пользователя ...'],
            'pluginOptions' => [
                'allowClear' => true,
                'ajax' => [
                    'url' => Url::to(['/dashboard/users/search']),
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                ],
            ],
        ])->label('Пользователь'); ?>
    </div>

    <div class="col-lg-4">
        <?= $form->field($filter, 'match_id')->textInput(['type' => 'number'])->label('ID матча') ?>
    </div>

    <div class="col-lg-4">
        <?= $form->field($filter, 'selected_team')->label('ID команды') ?>
    </div>

    <div class="form-group hidden">
        <button type="submit" class="btn btn-primary">Применить</button>
    </div>

    <?php $form::end(); ?>

    <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [
            'id',
            [
                'attribute' => 'user_id',
                'value' => function ($data) {
                    return $data->user->name;
                }
            ],
            [
                'attribute' => 'match_id',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::a($data->match_id, Url::to(['/dashboard/matches/view', 'id' => $data->match_id]));
                }
            ],
            [
                'attribute' => 'selected_team',
                'value' => function ($data) {
                    return $data->team->name;
                }
            ],
            [
                'attribute' => 'is_winner',
                'value' => function ($data) {
                    return YesOrNoEnum::label($data->is_winner);
                }
            ],
        ],
    ]); ?>


</div>
