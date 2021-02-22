<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TournamentMatch */

$this->title = 'Добавить игру';
?>
<div class="tournament-match-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
