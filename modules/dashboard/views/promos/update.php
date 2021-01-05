<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PromoCode */

$this->title = 'Редактировать промокод: ' . $model->id;
?>
<div class="promo-code-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
