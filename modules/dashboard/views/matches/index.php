<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $provider yii\data\ActiveDataProvider */

$this->title = 'Матчи';
?>
<div class="game-match-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить матч', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Сбросить счётчики', ['reset'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Прогнозы', ['predictions'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [

            'id',
            [
                'attribute' => 'first_team',
                'value' => function ($data) {
                    return $data->firstTeam->name;
                }
            ],
            [
                'attribute' => 'second_team',
                'value' => function ($data) {
                    return $data->secondTeam->name;
                }
            ],
            [
                'attribute' => 'winner_team',
                'value' => function ($data) {
                    return $data->getWinnerTeam();
                }
            ],
            'start_ts',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
