<?php

use app\components\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $provider yii\data\ActiveDataProvider */

$this->title = 'Карта сайта';
?>
<div class="publication-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <a href="<?= Url::to(['/dashboard/sitemap/refresh']) ?>" class="btn btn-success">Обновить</a>
    </p>

    <?= GridView::widget([
        'dataProvider' => $provider,
        'columns' => [
            'id',
            'url',
            'last_mod'
        ],
    ]); ?>


</div>
