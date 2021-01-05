<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ticker */

$this->title = 'Обновить элемент бегущей строки: ' . $model->id;
?>
<div class="ticker-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
