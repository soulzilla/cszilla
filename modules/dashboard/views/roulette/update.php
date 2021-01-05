<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LootBox */

$this->title = 'Редактировать сайт: ' . $model->name;
?>
<div class="loot-box-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
