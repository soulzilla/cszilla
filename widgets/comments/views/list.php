<?php

use app\models\Bookmaker;
use app\models\Casino;
use app\models\LootBox;
use yii\bootstrap4\Modal;

/** @var Bookmaker|Casino|LootBox $model */
?>

<?php Modal::begin([
    'id' => 'overviews-list',
    'title' => 'Обзоры'
]); ?>

    <?= $this->render('data/_overviews', ['models' => $model->overviews]) ?>

<?php Modal::end(); ?>

<?php Modal::begin([
    'id' => 'complaints-list',
    'title' => 'Жалобы'
]); ?>

    <?= $this->render('data/_complaints', ['models' => $model->complaints]) ?>

<?php Modal::end(); ?>
