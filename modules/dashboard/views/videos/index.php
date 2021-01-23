<?php

use app\enums\StreamSourcesEnum;
use app\enums\YesOrNoEnum;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $provider yii\data\ActiveDataProvider */

$this->title = 'Видео-материалы';
?>
<div class="video-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить видео', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [

            'id',
            'description:ntext',
            'url:url',
            [
                'attribute' => 'source',
                'value' => function ($data) {
                    return StreamSourcesEnum::label($data->source);
                }
            ],
            [
                'attribute' => 'is_published',
                'value' => function ($data) {
                    return YesOrNoEnum::label($data->is_published);
                }
            ],
            'ts',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
