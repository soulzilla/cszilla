<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $provider yii\data\ActiveDataProvider */

$this->title = 'Турниры';
?>
<div class="tournament-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать турнир', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [

            'id',
            'format',
            'serial_number',
            'is_published',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
