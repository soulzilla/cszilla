<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Box */

$this->title = 'Редактировать кейс: ' . $model->name;
?>
<div class="box-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
