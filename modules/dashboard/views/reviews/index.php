<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $provider yii\data\ActiveDataProvider */

$this->title = 'Отзывы';
?>
<div class="publication-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [

            'id',
            'content',
            'ts',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {delete}']
        ],
    ]); ?>


</div>
