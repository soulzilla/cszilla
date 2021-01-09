<?php

use app\components\helpers\StringHelper;
use app\enums\CurrenciesEnum;
use app\models\PromoCode;
use app\widgets\banners\Banners;
use app\widgets\like\Like;

/* @var $model PromoCode */

$this->title = 'Получите бонус по нашей ссылке - CS:GO Heaven';

$this->render('@app/components/templates/meta');
?>

<section class="blog-list-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 bordered-box text-break mx-3 mx-lg-0 mb-3 mb-lg-0 ">
                <div class="row">
                    <div class="col-auto ml-auto text-white-50">
                        <i class="fa fa-eye">
                            <span class="ml-1"><?= $model->counter->views ?></span>
                        </i>
                    </div>
                </div>
                <div class="blog-post single-post">
                    <div class="post-date"><?= StringHelper::humanize($model->ts) ?></div>
                    <p>
                        Сумма: <?= $model->amount ?>
                    </p>
                    <?= $model->description ?>
                </div>
                <?php if ($model->url): ?>
                    <div class="mt-3">
                        <a target="_blank" class="site-btn" href="<?= $model->url ?>">Активировать</a>
                    </div>
                <?php endif; ?>
                <div>
                    <?= Like::widget(['entity' => $model]) ?>
                </div>
            </div>
            <div class="col-lg-4 sidebar">
                <?= Banners::widget() ?>
            </div>
        </div>
    </div>
</section>
