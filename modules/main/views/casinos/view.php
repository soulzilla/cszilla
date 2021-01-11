<?php

/* @var $model Casino */

use app\components\helpers\Url;
use app\enums\CurrenciesEnum;
use app\enums\PaymentMethodsEnum;
use app\models\Casino;
use app\widgets\comments\Complaints;
use app\widgets\comments\EntityComments;
use app\widgets\comments\Overviews;
use app\widgets\like\Like;
use yii\bootstrap4\Tabs;

$this->title = $model->name . ' - CS:GO Heaven';

$this->render('@app/components/templates/meta', ['model' => $model]);
?>

<section class="game-section character-one py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 bordered-box text-break mx-3 mx-lg-0 mb-3 mb-lg-0">
                <div class="row">
                    <div class="col-auto ml-auto text-white-50">
                        <i class="fa fa-eye">
                            <span class="ml-1"><?= $model->counter->views ?></span>
                        </i>
                    </div>
                </div>
                <div class="about-game">
                    <div class="game-title mb-0">
                        <img src="<?= $model->logo ?>" style="width: 15rem; height: auto" alt="<?= $model->name_canonical ?>">
                        <h2><?= $model->name ?></h2>
                    </div>
                    <div class="rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                    </div>
                    <?= $model->description ?>
                </div>
                <div class="row">
                    <div class="col-6">
                        <h4 class="text-white mb-3">Плюсы</h4>
                        <?php foreach ($model->pros as $pro): ?>
                            <p class="text-break">
                                <i class="fa fa-plus-circle"></i>
                                <?= $pro ?>
                            </p>
                        <?php endforeach; ?>
                    </div>
                    <div class="col-6">
                        <h4 class="text-white mb-3">Минусы</h4>
                        <?php foreach ($model->cons as $con): ?>
                            <p class="text-break">
                                <i class="fa fa-minus-circle"></i>
                                <?= $con ?>
                            </p>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <p class="mb-0">Валюты:
                            <?php foreach ($model->currencies as $currency): ?>
                                <span class="text-white"><?= CurrenciesEnum::font($currency) ?></span>
                            <?php endforeach; ?>
                        </p>
                    </div>
                    <div class="col-6">
                        <p class="mb-0">Методы оплаты:
                            <?php foreach ($model->payment_methods as $payment_method):?>
                                <span class="text-white"><?= PaymentMethodsEnum::label($payment_method) ?></span>
                            <?php endforeach; ?>
                        </p>
                    </div>
                </div>
                <div class="mt-5">
                    <?= Like::widget(['entity' => $model]) ?>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="sb-widget bordered-box">
                    <h4 class="text-white mb-3">Промокоды</h4>
                    <?php if (sizeof($model->promoCodes)): ?>
                        <div class="latest-news-widget">
                            <?php foreach ($model->promoCodes as $promoCode): ?>
                                <hr/>
                                <div class="ln-item">
                                    <div class="ln-text">
                                        <?= $promoCode->description ?>
                                        <div class="ln-metas">
                                            <div class="ln-meta">
                                                <a target="_blank" href="<?= $promoCode->url ?>">
                                                    <i class="fa fa-gift"></i>
                                                    <?= $promoCode->amount ?>
                                                </a>
                                            </div>
                                            <div class="ln-meta">
                                                <a href="<?= Url::to(['/main/promos/view', 'id' => $promoCode->id]) ?>">Подробнее</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p>
                            Промокодов пока нет.
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?= EntityComments::widget([
    'entity' => $model
]) ?>
