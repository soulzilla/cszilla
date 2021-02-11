<?php

use app\enums\FaqCategoriesEnum;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $provider yii\data\ActiveDataProvider */

$this->title = 'Часто задаваемые вопросы';
?>
<div class="faq-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить вопрос', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            ['attribute' => 'category', 'value' => function ($data) { return FaqCategoriesEnum::label($data->category); }],
            'order',
            'question',
            'answer:ntext',
            //'ts',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
