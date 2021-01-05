<?php

use app\enums\YesOrNoEnum;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Review */

$this->title = 'Отзыв ' . $model->id;
YiiAsset::register($this);
?>
<div class="publication-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот отзыв?',
                'method' => 'post',
            ],
        ]) ?>
        <?php if ($model->is_published): ?>
            <?= Html::a('Снять с публикации', ['hide', 'id' => $model->id], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите снять с публикации этот отзыв?',
                    'method' => 'post',
                ]
            ]) ?>
        <?php else: ?>
            <?= Html::a('Опубликовать', ['publish', 'id' => $model->id], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите опубликовать этот отзыв?',
                    'method' => 'post',
                ]
            ]) ?>
        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'content:ntext',
            [
                'attribute' => 'author_id',
                'value' => $model->author->name
            ],
            [
                'attribute' => 'is_published',
                'value' => YesOrNoEnum::label($model->is_published)
            ],
            'order',
            'ts'
        ],
    ]) ?>

</div>
