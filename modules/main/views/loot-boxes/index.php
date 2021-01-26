<?php

use app\components\helpers\Url;
use app\models\LootBox;
use app\widgets\banners\Banners;
use app\widgets\rating\Rating;
use yii\data\ActiveDataProvider;

/* @var $provider ActiveDataProvider */
/* @var $models LootBox[] */

$this->title = 'Сайты с лутбоксами - CSZilla';
$models = $provider->getModels();
?>

<?= Banners::widget() ?>

<div class="nk-gap-2"></div>

<ul class="nk-breadcrumbs">
    <li><a href="<?= Url::to(['/main/default/index']) ?>">Главная</a></li>

    <li><span class="fa fa-angle-right"></span></li>

    <li><span>Сайты с лутбоксами</span></li>
</ul>

<div class="nk-gap-2"></div>

<?php if (sizeof($models)): ?>
    <?php foreach ($models as $key => $model): ?>
        <div class="nk-product-cat-2">
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

                <?= $model->description ?>

                <a href="<?= $model->website ?>"
                   class="nk-btn nk-btn-rounded nk-btn-color-dark-3 nk-btn-hover-color-main-1">
                    На сайт
                </a>
            </div>
        </div>
        <div class="nk-gap-2"></div>
    <?php endforeach; ?>
<?php endif; ?>

<div class="nk-gap-2"></div>