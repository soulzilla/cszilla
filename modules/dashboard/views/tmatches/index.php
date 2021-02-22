<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $provider yii\data\ActiveDataProvider */

$this->title = 'Турнирные игры';
?>
<div class="tournament-match-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [

            'id',
            'tournament_id',
            'first_team',
            'second_team',
            'stage',
            'score_first',
            'score_second',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
