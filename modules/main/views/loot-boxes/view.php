<?php

/* @var $model LootBox */

use app\components\helpers\Url;
use app\enums\CurrenciesEnum;
use app\models\LootBox;
use app\widgets\comments\EntityComments;
use yii\bootstrap4\Html;

$this->title = $model->name . ' - CSZilla';

$this->render('@app/components/templates/meta', ['model' => $model]);
?>
    <div class="nk-gap"></div>

    <ul class="nk-breadcrumbs">
        <li><a href="<?= Url::to(['/main/default/index']) ?>">Главная</a></li>

        <li><span class="fa fa-angle-right"></span></li>

        <li><a href="<?= Url::to(['/main/loot-boxes/index']) ?>">Лутбоксы</a></li>

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
                        <?php if (sizeof($model->attachedItems)): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="#tab-gallery" role="tab" data-toggle="tab">Галерея</a>
                            </li>
                        <?php endif; ?>
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
                <?php if ($model->boxes): ?>
                    <table class="nk-table">
                        <thead>
                            <tr>
                                <th class="text-center" colspan="3">Кейсы</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="text-center w-50">Название</th>
                                <th class="text-center">Цена</th>
                                <th class="text-center" title="Средняя стоимость скинов за n количество открытий">Дроп</th>
                            </tr>
                            <?php foreach ($model->boxes as $box): ?>
                                <tr>
                                    <td><?= $box->show_url ? Html::a($box->name, $box->url, ['target' => '_blank']) : $box->name ?></td>
                                    <td class="text-center"><?= $box->cost ?></td>
                                    <td class="text-center"><?= $box->average_drop ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>

                <?php if (sizeof($model->attachedItems)): ?>
                    <div class="nk-gap-2"></div>
                    <div role="tabpanel" class="tab-pane fade" id="tab-gallery">
                        <?= $this->render('@app/modules/main/views/common/popup_gallery', ['model' => $model]) ?>
                    </div>
                <?php endif; ?>

                <?php if ($model->bonuses): ?>
                    <div class="nk-gap-2"></div>
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

                <?php if ($model->promoCodes): ?>
                    <div class="nk-gap-2"></div>
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
    <div class="nk-gap-2"></div>

<?= $this->render('@app/modules/main/views/common/partner_bonuses_modals', ['model' => $model]) ?>

<?= $this->render('@app/modules/main/views/common/partner_promos_modals', ['model' => $model]) ?>