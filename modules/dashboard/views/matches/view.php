<?php

use app\enums\YesOrNoEnum;
use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GameMatch */

$this->title = $model->id;
YiiAsset::register($this);
?>
<div class="game-match-view">

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
            [
                'attribute' => 'first_team',
                'value' => $model->firstTeam->name
            ],
            [
                'attribute' => 'second_team',
                'value' => $model->secondTeam->name
            ],
            [
                'attribute' => 'winner_team',
                'value' => $model->getWinnerTeam()
            ],
            [
                'attribute' => 'is_finished',
                'value' => YesOrNoEnum::label($model->is_finished)
            ],
            'final_score',
            'start_ts',
        ],
    ]) ?>

</div>
