<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\WalletTask */

$this->title = 'Добавить задание';
?>
<div class="wallet-task-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
