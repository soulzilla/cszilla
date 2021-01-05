<?php

use app\enums\CurrenciesEnum;
use app\enums\EntityTablesEnum;
use app\enums\YesOrNoEnum;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Bonus */

$this->title = $model->id;
YiiAsset::register($this);
?>
<div class="bonus-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот бонус?',
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
            [
                'attribute' => 'currency',
                'value' => CurrenciesEnum::label($model->currency)
            ],
            'url:url',
            [
                'attribute' => 'pinned',
                'value' => YesOrNoEnum::label($model->pinned)
            ],
            [
                'attribute' => 'is_published',
                'value' => YesOrNoEnum::label($model->is_published)
            ],
            'ts',
        ],
    ]) ?>

    <p>
        <b>Описание:</b>
        <?= $model->description ?>
        <b>Правила:</b>
        <?= $model->rules ?>
    </p>

</div>
