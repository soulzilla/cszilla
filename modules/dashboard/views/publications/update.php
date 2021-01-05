<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Publication */
/* @var $categories string[] */

$this->title = 'Редактировать пост: ' . $model->title;
?>
<div class="publication-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories
    ]) ?>

</div>
