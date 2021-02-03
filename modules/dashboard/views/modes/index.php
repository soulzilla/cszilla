<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $provider yii\data\ActiveDataProvider */

$this->title = 'Игровые режимы';
?>
<div class="game-mode-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить режим', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [

            'id',
            [
                'attribute' => 'casino_id',
                'value' => function ($data) {
                    return $data->casino->name;
                }
            ],
            'name',
            'order',
            'description:ntext',
            //'ts',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
