<?php

use app\components\helpers\Url;
use app\enums\{CurrenciesEnum, PaymentMethodsEnum, YesOrNoEnum};
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Casino */

$this->title = $model->name;
YiiAsset::register($this);
?>
<div class="casino-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('SEO', ['seo', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Режимы', ['/dashboard/modes/index', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Добавить бонус', Url::to(['/dashboard/bonuses/create', 'entity_id' => $model->id, 'entity_table' => $model->tableName()]), ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Добавить промокод', Url::to(['/dashboard/promos/create', 'entity_id' => $model->id, 'entity_table' => $model->tableName()]), ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить это казино?',
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
