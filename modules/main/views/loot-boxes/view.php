<?php

/* @var $model LootBox */

use app\components\helpers\Url;
use app\enums\BoxesEnum;
use app\enums\CurrenciesEnum;
use app\enums\PaymentMethodsEnum;
use app\models\LootBox;
use app\widgets\comments\EntityComments;
use app\widgets\like\Like;
use app\widgets\rating\Rating;

$this->title = $model->name . ' - CSZilla';

$this->render('@app/components/templates/meta', ['model' => $model]);
?>

<section class="game-section character-one py-3 pb-lg-0">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 bordered-box text-break mb-3 mx-3 mx-lg-0" style="max-width: 90%;">
                <div class="row">
                    <div class="col-auto ml-auto text-white-50">
                        <i class="fa fa-eye">
                            <span class="ml-1"><?= $model->counter->views ?></span>
                        </i>
                    </div>
                </div>
                <div class="about-game">
                    <div class="game-title mb-0">
                        <img src="<?= $model->logo ?>" style="width: 15rem; height: auto"
                             alt="<?= $model->name_canonical ?>">

                        <h2><?= $model->name ?></h2>

                        <?php if (Yii::$app->usersService->isGranted(['ROLE_SUPER_ADMIN'])): ?>
                            <a class="text-white"
                               href="<?= Url::to(['/dashboard/roulette/update', 'id' => $model->id]) ?>">
                                <i class="fa fa-pencil"></i>
                            </a>
                        <?php endif; ?>
                    </div>

                    <?= Rating::widget(['model' => $model]) ?>

                    <?= $this->render('@app/modules/main/views/common/partner_counters', ['model' => $model]) ?>

                    <?= $model->description ?>
                </div>

                <?= $this->render('@app/modules/main/views/common/partner_pros', ['model' => $model]) ?>

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
                            <?php foreach ($model->payment_methods as $payment_method): ?>
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

<?php if ($model->boxes): ?>
    <div class="container pl-3 pl-lg-0 mb-3">
        <div class="bordered-box">
            <div class="row text-white">
                <div class="col-4">
                    Кейс
                </div>
                <div class="col-4 text-center">
                    Стоимость
                </div>
                <div class="col-4 text-center">
                    Средний дроп
                </div>
            </div>
            <?php foreach (BoxesEnum::labels() as $key => $label): $costAttr = $key . '_cost';
                $averageAttr = $key . '_average'; ?>
                <div class="row text-white">
                    <div class="col-4">
                        <?= $label ?>
                    </div>
                    <div class="col-4 text-center">
                        <?= $model->boxes->getAttribute($costAttr) ?? '-' ?>
                    </div>
                    <div class="col-4 text-center">
                        <?= $model->boxes->getAttribute($averageAttr) ?? '-' ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<?= EntityComments::widget([
    'entity' => $model
]) ?>
