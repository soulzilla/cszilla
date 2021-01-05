<?php

use app\enums\EntityTablesEnum;
use app\enums\YesOrNoEnum;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PromoCode */

$this->title = $model->id;
YiiAsset::register($this);
?>
<div class="promo-code-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот промокод?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute' => 'entity_id',
                'value' => $model->getEntity() ? $model->getEntity()->name : ''
            ],
            [
                'attribute' => 'entity_table',
                'value' => EntityTablesEnum::label($model->entity_table)
            ],
            'amount',
            'url:url',
            'code',
            'activations',
            'ts',
            [
                'attribute' => 'is_published',
                'value' => YesOrNoEnum::label($model->is_published)
            ],
        ],
    ]) ?>

    <p>
        <b>Описание:</b>
        <?= $model->description ?>
    </p>

</div>
