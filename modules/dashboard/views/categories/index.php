<?php

use app\enums\YesOrNoEnum;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $provider yii\data\ActiveDataProvider */

$this->title = 'Категории постов';
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [

            'id',
            'name',
            'name_canonical',
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
