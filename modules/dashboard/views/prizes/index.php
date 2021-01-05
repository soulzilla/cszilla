<?php

use app\enums\YesOrNoEnum;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $provider yii\data\ActiveDataProvider */

$this->title = 'Призы';
?>
<div class="prize-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [

            'id',
            'contest_id',
            'name',
            [
                'attribute' => 'sent',
                'value' => function ($data) {
                    return YesOrNoEnum::label($data->sent);
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
