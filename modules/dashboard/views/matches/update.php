<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\GameMatch */

$this->title = 'Редактировать матч: ' . $model->id;
?>
<div class="game-match-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
