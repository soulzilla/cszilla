<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Bonus */

$this->title = 'Обновить бонус: ' . $model->id;
?>
<div class="bonus-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
