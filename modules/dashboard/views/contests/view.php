<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Contest */

$this->title = 'Розыгрыш №' . $model->id;
YiiAsset::register($this);
?>
<div class="contest-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Подвести итоги', ['roll', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Добавить приз', ['/dashboard/prizes/create', 'contest_id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот розыгрыш?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'date_start',
            'date_end',
            'partner_id',
            'partner_type',
            'is_published',
            'winners_count',
            'ts',
        ],
    ]) ?>

    <p>
        <b>Описание:</b>
        <?= $model->description ?>
    </p>

</div>
