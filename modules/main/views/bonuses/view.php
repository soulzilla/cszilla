<?php

use app\components\helpers\StringHelper;
use app\enums\CurrenciesEnum;
use app\models\Bonus;
use app\widgets\banners\Banners;
use app\widgets\like\Like;

/* @var $model Bonus */

$this->title = 'Получите бонус по нашей ссылке - CSZilla';

$this->render('@app/components/templates/meta');
?>

<section class="blog-list-section pt-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 bordered-box text-break mx-3 mx-lg-0 mb-3 mb-lg-0 position-relative">
                <div class="row">
                    <div class="col-auto ml-auto text-white-50">
                        <i class="fa fa-eye">
                            <span class="ml-1"><?= $model->counter->views ?></span>
                        </i>
                    </div>
                </div>
                <div class="blog-post single-post">
                    <div class="date-text mb-3" title="<?= StringHelper::humanize($model->ts, true) ?>">
                        <?= StringHelper::humanize($model->ts) ?>
                    </div>
                    <?= $model->description ?>

                    <?= $model->rules ?>

                    <?php if ($model->url): ?>
                        <div class="mt-3">
                            <a target="_blank" class="site-btn" href="<?= $model->url ?>">Получить</a>
                        </div>
                    <?php endif; ?>
                </div>

                <?= Like::widget(['entity' => $model]) ?>
            </div>
            <div class="col-lg-4 sidebar">
                <?= Banners::widget() ?>
            </div>
        </div>
    </div>
</section>
