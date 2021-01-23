<?php

use app\enums\StreamSourcesEnum;
use app\enums\YesOrNoEnum;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Video */

$this->title = 'Видео ' . $model->id;
\yii\web\YiiAsset::register($this);
?>
<div class="video-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'description:ntext',
            'url:url',
            [
                'attribute' =>' source',
                'value' => StreamSourcesEnum::label($model->source)
            ],
            [
                'attribute' =>' is_published',
                'value' => YesOrNoEnum::label($model->is_published)
            ],
            'ts',
        ],
    ]) ?>

</div>
