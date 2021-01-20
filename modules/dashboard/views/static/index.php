<?php

use app\components\helpers\Url;
use app\enums\StaticBlockEnum;
use app\models\StaticBlock;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $provider yii\data\ActiveDataProvider */

$this->title = 'Статичные блоки';
?>
<div class="publication-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <a href="<?= Url::to(['/dashboard/static/refresh']) ?>" class="btn btn-success">Обновить</a>
    </p>

    <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [
            [
                'attribute' => 'type',
                'value' => function (StaticBlock $model) {
                    return StaticBlockEnum::label($model->type);
                }
            ],
            'content',
            'ts',

            ['class' => 'yii\grid\ActionColumn']
        ],
    ]); ?>


</div>
