<?php

use app\enums\YesOrNoEnum;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Prize */

$this->title = $model->name;
YiiAsset::register($this);
?>
<div class="prize-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот приз?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'contest_id',
            'name',
            'image:url',
            [
                'attribute' => 'sent',
                'value' => YesOrNoEnum::label($model->sent)
            ]
        ],
    ]) ?>

</div>
