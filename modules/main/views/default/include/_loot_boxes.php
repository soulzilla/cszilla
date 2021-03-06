<?php

/** @var $models app\models\LootBox[] */

use app\components\helpers\Url;
use app\widgets\rating\Rating;

?>
<?php if (sizeof($models)): ?>
    <h3 class="nk-decorated-h-2"><span><span class="text-main-1">Лучшие</span> сайты с лутбоксами</span></h3>
    <div class="nk-gap"></div>

    <?php foreach ($models as $model): ?>
        <div class="nk-product-cat">
            <a class="nk-product-image"
               href="<?= Url::to(['/main/loot-boxes/view', 'name_canonical' => $model->name_canonical]) ?>">
                <img src="<?= $model->logo ?>" alt="<?= $model->name_canonical ?>">
            </a>
            <div class="nk-product-cont">
                <h3 class="nk-product-title h5">
                    <a href="<?= Url::to(['/main/loot-boxes/view', 'name_canonical' => $model->name_canonical]) ?>">
                        <?= $model->name ?>
                    </a>
                </h3>
                <div class="nk-gap-1"></div>
                <div class="nk-product-rating" data-rating="<?= (int)$model->counter->average_rating ?>">
                    <?= Rating::widget(['model' => $model]) ?>
                </div>
                <div class="nk-gap-1"></div>
                <a target="_blank" href="<?= $model->website ?>" class="nk-btn nk-btn-rounded nk-btn-color-dark-3 nk-btn-hover-color-main-1">
                    На сайт
                </a>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="nk-gap-2"></div>

<?php endif; ?>
