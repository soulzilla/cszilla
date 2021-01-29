<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GameMode */

$this->title = 'Редактировать режим: ' . $model->name;
?>
<div class="game-mode-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
