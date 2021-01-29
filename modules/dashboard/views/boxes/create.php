<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Box */

$this->title = 'Создать кейс';
?>
<div class="box-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
