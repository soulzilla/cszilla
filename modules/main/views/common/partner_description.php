<?php

/* @var $model LootBox|Bookmaker|Casino */

use app\widgets\like\Like;
use app\models\{LootBox, Bookmaker, Casino};
use app\widgets\rating\Rating;

?>

<div role="tabpanel" class="tab-pane fade show active" id="tab-description">
    <div class="nk-gap"></div>

    <div class="nk-info-box pl-30 pr-10 position-relative">
        <div class="nk-post-categories">
            <span class="nk-color-dark-3"><i class="fa fa-eye pr-3"></i><?= $model->counter->views ?></span>
        </div>

        <?= $model->description ?>

        <div class="row vertical-gap pl-0">
            <div class="col-md-4 text-left text-md-center">
                <div class="nk-gap"></div>
                <strong class="text-white">Плюсы:</strong>
                <div class="nk-gap"></div>
                <?php foreach ($model->pros as $pro): ?>
                    <p><?= $pro ?></p>
                <?php endforeach; ?>
            </div>
            <div class="col-md-4 text-left text-md-center">
                <div class="nk-gap"></div>
                <strong class="text-white">Минусы:</strong>
                <div class="nk-gap"></div>
                <?php foreach ($model->cons as $con): ?>
                    <p><?= $con ?></p>
                <?php endforeach; ?>
            </div>
            <div class="col-md-4 text-left text-md-center">
                <div class="nk-gap"></div>
                <strong class="text-white">Ваша оценка:</strong>
                <div class="nk-gap"></div>
                <div class="nk-product-rating" data-rating="<?= $model->rating ? $model->rating->rate : '0' ?>">
                    <?= Rating::widget(['model' => $model]) ?>
                </div>
            </div>
        </div>

        <div class="nk-gap-2"></div>

        <?= Like::widget(['entity' => $model]) ?>
    </div>

    <div class="nk-gap-2"></div>
</div>
