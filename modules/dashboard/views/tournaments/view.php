<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tournament */

$this->title = $model->id;
YiiAsset::register($this);
?>
<div class="tournament-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Добавить матч', ['/dashboard/tmatches/create', 'tournament_id' => $model->id], ['class' => 'btn btn-primary']) ?>
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
            'format',
            'regulations:ntext',
            'twitch_stream',
            'show_stream',
            'competitors_limit',
            'prize_pool:ntext',
            'serial_number',
            'date_start',
            'ts',
            'is_published',
        ],
    ]) ?>

</div>
