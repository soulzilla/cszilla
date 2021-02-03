<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LootBox */

$this->title = 'Добавить сайт с лутбоксами';
?>
<div class="loot-box-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
