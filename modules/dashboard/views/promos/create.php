<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PromoCode */

$this->title = 'Добавить промокод';
?>
<div class="promo-code-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
