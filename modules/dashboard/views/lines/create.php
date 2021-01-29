<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\BetLine */

$this->title = 'Добавить линию';
?>
<div class="bet-line-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
