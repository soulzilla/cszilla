<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $provider yii\data\ActiveDataProvider */

$this->title = 'Линия ставок';
?>
<div class="bet-line-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить линию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [

            'id',
            [
                'attribute' => 'bookmaker_id',
                'value' => function ($data) {
                    return $data->bookmaker->name;
                }
            ],
            'name',
            'order',
            'ts',
        ],
    ]); ?>


</div>
