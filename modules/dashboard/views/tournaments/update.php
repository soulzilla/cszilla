<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tournament */

$this->title = 'Редактировать турнир: ' . $model->id;
?>
<div class="tournament-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
