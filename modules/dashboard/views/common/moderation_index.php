<?php

use app\enums\YesOrNoEnum;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;

/** @var $provider ActiveDataProvider */
/** @var $bodyAttribute string */
?>

<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [

            'id',
            'entity_table',
            'entity_id',
            $bodyAttribute,
            [
                'attribute' => 'user_id',
                'value' => function ($data) {
                    return $data->author->name;
                }
            ],
            [
                'attribute' => 'is_deleted',
                'value' => function ($data) {
                    return YesOrNoEnum::label($data->is_deleted);
                }
            ],
            'ts',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{delete}'],
        ],
    ]); ?>


</div>

