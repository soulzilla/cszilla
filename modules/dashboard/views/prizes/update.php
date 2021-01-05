<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Prize */

$this->title = 'Обновить приз: ' . $model->name;
?>
<div class="prize-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
