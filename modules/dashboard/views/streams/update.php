<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Stream */

$this->title = 'Редактировать стрим: ' . $model->id;
?>
<div class="stream-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
