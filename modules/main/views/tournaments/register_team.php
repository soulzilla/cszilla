<?php

/** @var $this yii\web\View */
/** @var $model app\models\CustomTeam */

use app\components\helpers\Url;
use app\models\Tournament;
use app\widgets\comments\Comments;
use app\widgets\stream\Stream;
use app\widgets\videos\Videos;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Регистрация команды';
?>


<div class="nk-gap-2"></div>

<ul class="nk-breadcrumbs">
    <li><a href="<?= Url::to(['/main/default/index']) ?>">Главная</a></li>

    <li><span class="fa fa-angle-right"></span></li>

    <li><a href="<?= Url::to(['/main/tournaments/index']) ?>">Турниры</a></li>

    <li><span class="fa fa-angle-right"></span></li>

    <li>
        <span><?= $this->title ?></span>
    </li>
</ul>


<div class="row vertical-gap">
    <div class="col-lg-8">
        <div class="nk-gap-2">
            <?php $form = ActiveForm::begin() ?>

            <?= $form->field($model, 'name') ?>

            <div class="form-group">
                <?= Html::submitButton('Подтвердить', ['class' => 'nk-btn nk-btn-rounded nk-btn-color-white nk-btn-block', 'name' => 'accept-button']) ?>
            </div>

            <?php $form::end() ?>
        </div>
    </div>

    <div class="col-lg-4">
        <aside class="nk-sidebar nk-sidebar-right nk-sidebar-sticky">
            <div class="nk-gap-2"></div>
            <?= Videos::widget() ?>

            <?= Stream::widget() ?>

            <?= Comments::widget([
                'tableName' => Tournament::tableName()
            ]) ?>
        </aside>
    </div>
</div>