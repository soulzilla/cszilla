<?php

/* @var $model LootBox */

use app\components\helpers\Url;
use app\enums\CurrenciesEnum;
use app\models\LootBox;
use app\widgets\comments\EntityComments;

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
                                <th class="text-center" colspan="3">Кейсы по раритетности</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="text-center w-50">Кейс</th>
                                <th class="text-center">Цена</th>
                                <th class="text-center">Дроп</th>
                            </tr>
                            <tr>
                                <td>Армейский</td>
                                <td class="text-center"><?= $model->boxes->military_cost ?></td>
                                <td class="text-center"><?= $model->boxes->military_average ?></td>
                            </tr>
                            <tr>
                                <td>Запрещённый</td>
                                <td class="text-center"><?= $model->boxes->restricted_cost ?></td>
                                <td class="text-center"><?= $model->boxes->restricted_average ?></td>
                            </tr>
                            <tr>
                                <td>Засекреченный</td>
                                <td class="text-center"><?= $model->boxes->classified_cost ?></td>
                                <td class="text-center"><?= $model->boxes->classified_average ?></td>
                            </tr>
                            <tr>
                                <td>Тайный</td>
                                <td class="text-center"><?= $model->boxes->covert_cost ?></td>
                                <td class="text-center"><?= $model->boxes->covert_average ?></td>
                            </tr>
                            <tr>
                                <td>Ножевой</td>
                                <td class="text-center"><?= $model->boxes->knife_cost ?></td>
                                <td class="text-center"><?= $model->boxes->knife_average ?></td>
                            </tr>
                            <tr>
                                <td>Перчаточный</td>
                                <td class="text-center"><?= $model->boxes->gloves_cost ?></td>
                                <td class="text-center"><?= $model->boxes->gloves_average ?></td>
                            </tr>
                            <tr>
                                <td>Топовый</td>
                                <td class="text-center"><?= $model->boxes->top_cost ?></td>
                                <td class="text-center"><?= $model->boxes->top_average ?></td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="nk-gap-2"></div>

                    <table class="nk-table">
                        <thead>
                            <tr>
                                <th class="text-center" colspan="3">Кейсы по оружиям</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th class="text-center w-50">Кейс</th>
                                <th class="text-center">Цена</th>
                                <th class="text-center">Дроп</th>
                            </tr>
                            <tr>
                                <td>USP</td>
                                <td class="text-center"><?= $model->boxes->usp_cost ?></td>
                                <td class="text-center"><?= $model->boxes->usp_average ?></td>
                            </tr>
                            <tr>
                                <td>Glock</td>
                                <td class="text-center"><?= $model->boxes->glock_cost ?></td>
                                <td class="text-center"><?= $model->boxes->glock_average ?></td>
                            </tr>
                            <tr>
                                <td>Deagle</td>
                                <td class="text-center"><?= $model->boxes->deagle_cost ?></td>
                                <td class="text-center"><?= $model->boxes->deagle_average ?></td>
                            </tr>
                            <tr>
                                <td>AK-47</td>
                                <td class="text-center"><?= $model->boxes->ak_cost ?></td>
                                <td class="text-center"><?= $model->boxes->ak_average ?></td>
                            </tr>
                            <tr>
                                <td>M4A4</td>
                                <td class="text-center"><?= $model->boxes->m4a4_cost ?></td>
                                <td class="text-center"><?= $model->boxes->m4a4_average ?></td>
                            </tr>
                            <tr>
                                <td>M4A1-S</td>
                                <td class="text-center"><?= $model->boxes->m4a1_cost ?></td>
                                <td class="text-center"><?= $model->boxes->m4a1_average ?></td>
                            </tr>
                            <tr>
                                <td>AWP</td>
                                <td class="text-center"><?= $model->boxes->awp_cost ?></td>
                                <td class="text-center"><?= $model->boxes->awp_average ?></td>
                            </tr>
                        </tbody>
                    </table>
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