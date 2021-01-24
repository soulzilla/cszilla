<?php

use app\enums\YesOrNoEnum;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Publication */

$this->title = $model->title;
YiiAsset::register($this);
?>
<div class="publication-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('SEO', ['seo', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php if ($model->is_deleted): ?>
            <?= Html::a('Восстановить', ['restore', 'id' => $model->id], [
                'class' => 'btn btn-warning',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите восстановить этот пост?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php else: ?>
            <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить этот пост?',
                    'method' => 'post',
                ],
            ]) ?>
        <?php endif; ?>
        <?php if ($model->is_blocked): ?>
            <?= Html::a('Разблокировать', ['unblock', 'id' => $model->id], [
                'class' => 'btn btn-warning',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите разблокировать этот пост?',
                    'method' => 'post',
                ]
            ]) ?>
        <?php else: ?>
            <?= Html::a('Заблокировать', ['block', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите заблокировать этот пост?',
                    'method' => 'post',
                ]
            ]) ?>
        <?php endif; ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'category_id',
                'value' => $model->category->name
            ],
            'title',
            'title_canonical',
            [
                'attribute' => 'author_id',
                'value' => $model->author->name
            ],
            'publish_date',
            [
                'attribute' => 'is_published',
                'value' => YesOrNoEnum::label($model->is_published)
            ],
            [
                'attribute' => 'is_blocked',
                'value' => YesOrNoEnum::label($model->is_blocked)
            ],
            [
                'attribute' => 'is_deleted',
                'value' => YesOrNoEnum::label($model->is_deleted)
            ],
            'ts'
        ],
    ]) ?>

    <p>
        <b>Текст:</b>
        <?= $model->body ?>
    </p>

</div>
