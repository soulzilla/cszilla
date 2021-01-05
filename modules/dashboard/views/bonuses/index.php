<?php

use app\enums\CurrenciesEnum;
use app\enums\EntityTablesEnum;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $provider yii\data\ActiveDataProvider */

$this->title = 'Бонусы';
?>
<div class="bonus-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [

            'id',
            [
                'attribute' => 'entity_id',
                'value' => function ($data) {
                    return $data->getEntity() ? $data->getEntity()->name : '';
                }
            ],
            [
                'attribute' => 'entity_table',
                'value' => function ($data) {
                    return EntityTablesEnum::label($data->entity_table);
                }
            ],
            'amount',
            [
                'attribute' => 'currency',
                'value' => function ($data) {
                    return CurrenciesEnum::label($data->currency);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
