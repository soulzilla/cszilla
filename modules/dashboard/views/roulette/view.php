<?php

use app\enums\{CurrenciesEnum, PaymentMethodsEnum, YesOrNoEnum};
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\LootBox */

$this->title = $model->name;
YiiAsset::register($this);
?>
<div class="loot-box-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('SEO', ['seo', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Кейсы', ['boxes', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Добавить промокод', ['/dashboard/promos/create', 'entity_table' => $model->tableName(), 'entity_id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот сайт?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'name_canonical',
            [
                'attribute' => 'logo',
                'value' => $model->logo,
                'format' => ['image', ['width' => '100', 'height' => '100']],
            ],
            'order',
            [
                'attribute' => 'currencies',
                'value' => CurrenciesEnum::icon($model->currencies)
            ],
            [
                'attribute' => 'payment_methods',
                'value' => PaymentMethodsEnum::icon($model->payment_methods)
            ],
            'website:url',
            [
                'attribute' => 'recommended',
                'value' => YesOrNoEnum::label($model->recommended)
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

        <b>Плюсы:</b>
        <?= $model->getPros() ?>

        <b>Минусы:</b>
        <?= $model->getCons() ?>
    </p>

</div>
