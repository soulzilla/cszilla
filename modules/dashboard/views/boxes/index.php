<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $provider yii\data\ActiveDataProvider */

$this->title = 'Кейсы';
?>
<div class="box-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить кейс', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [

            'id',
            [
                'attribute' => 'site_id',
                'value' => function ($data) {
                    return $data->site->name;
                }
            ],
            'name',
            'url:url',
            //'cost',
            //'average_drop',
            //'ts',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
