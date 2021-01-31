<?php

use app\components\helpers\Url;
use app\models\Bookmaker;
use app\widgets\banners\Banners;
use app\widgets\comments\Comments;
use app\widgets\rating\Rating;
use app\widgets\stream\Stream;
use app\widgets\videos\Videos;
use yii\data\ActiveDataProvider;

/* @var $provider ActiveDataProvider */
/* @var $models Bookmaker[] */

$this->title = 'Букмекеры - CSZilla';
$models = $provider->getModels();
?>

<?= Banners::widget() ?>

<div class="nk-gap-2"></div>

<ul class="nk-breadcrumbs">
    <li><a href="<?= Url::to(['/main/default/index']) ?>">Главная</a></li>

    <li><span class="fa fa-angle-right"></span></li>

    <li><span>Букмекеры</span></li>
</ul>


<div class="row vertical-gap">
    <div class="col-lg-8">
        <div class="nk-gap-2"></div>

        <?php if (sizeof($models)): ?>
            <?php foreach ($models as $key => $model): ?>
                <div class="nk-product-cat-2">
                    <a class="nk-product-image"
                       href="<?= Url::to(['/main/bookmakers/view', 'name_canonical' => $model->name_canonical]) ?>">
                        <img src="<?= $model->logo ?>" alt="<?= $model->name_canonical ?>">
                    </a>
                    <div class="nk-product-cont">
                        <h3 class="nk-product-title h5">
                            <a href="<?= Url::to(['/main/bookmakers/view', 'name_canonical' => $model->name_canonical]) ?>">
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
    </div>

    <div class="col-lg-4">
        <aside class="nk-sidebar nk-sidebar-right nk-sidebar-sticky">
            <div class="nk-gap-2"></div>

            <?= Videos::widget() ?>

            <?= Stream::widget() ?>

            <?= Comments::widget([
                'tableName' => Bookmaker::tableName()
            ]) ?>
        </aside>
    </div>
</div>

<div class="nk-gap-2"></div>