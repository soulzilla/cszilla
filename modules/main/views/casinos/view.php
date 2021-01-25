<?php

/* @var $model Casino */

use app\components\helpers\Url;
use app\enums\CurrenciesEnum;
use app\models\Casino;
use app\widgets\comments\EntityComments;

$this->title = $model->name . ' - CSZilla';

$this->render('@app/components/templates/meta', ['model' => $model]);
?>
<div class="nk-gap"></div>

<ul class="nk-breadcrumbs">
    <li><a href="<?= Url::to(['/main/default/index']) ?>">Главная</a></li>

    <li><span class="fa fa-angle-right"></span></li>

    <li><a href="<?= Url::to(['/main/casinos/index']) ?>">Рулетки</a></li>

    <li><span class="fa fa-angle-right"></span></li>

    <li><span><?= $model->name ?></span></li>

</ul>

<div class="nk-gap"></div>

<div class="row">
    <div class="col-lg-8">
        <div class="nk-store-product">

            <?= $this->render('@app/modules/main/views/common/partner_counters', ['model' => $model]) ?>

            <div class="nk-gap-2"></div>

            <div class="nk-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" href="#tab-description" role="tab" data-toggle="tab">Описание</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tab-conversation" role="tab" data-toggle="tab">Обсуждение</a>
                    </li>
                </ul>

                <div class="tab-content">

                    <?= $this->render('@app/modules/main/views/common/partner_description', ['model' => $model]) ?>

                    <div role="tabpanel" class="tab-pane fade" id="tab-conversation">
                        <div class="nk-gap-2"></div>
                        <?= EntityComments::widget(['entity' => $model]) ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <aside class="nk-sidebar nk-sidebar-right nk-sidebar-sticky">

            <div class="nk-gap-2"></div>
            <?php if ($model->bonuses): ?>
                <div class="nk-widget nk-widget-highlighted">
                    <h4 class="nk-widget-title"><span class="text-main-1">Бонусы</span></h4>
                    <div class="nk-widget-content">
                        <ul class="nk-widget-categories">
                            <?php foreach ($model->bonuses as $bonus): ?>
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#bonus-<?= $bonus->id ?>">
                                        <?= $bonus->amount ?> <?= CurrenciesEnum::font($bonus->currency) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

            <div class="nk-gap-2"></div>
            <?php if ($model->promoCodes): ?>
                <div class="nk-widget nk-widget-highlighted">
                    <h4 class="nk-widget-title"><span class="text-main-1">Промкоды</span></h4>
                    <div class="nk-widget-content">
                        <ul class="nk-widget-categories">
                            <?php foreach ($model->promoCodes as $promoCode): ?>
                                <li>
                                    <a href="#" data-toggle="modal" data-target="#promo-<?= $promoCode->id ?>">
                                        <?= $promoCode->amount ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </aside>
    </div>
</div>

<?= $this->render('@app/modules/main/views/common/partner_bonuses_modals', ['model' => $model]) ?>

<?= $this->render('@app/modules/main/views/common/partner_promos_modals', ['model' => $model]) ?>