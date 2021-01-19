<?php

/* @var $model LootBox */

use app\components\helpers\Url;
use app\enums\BoxesEnum;
use app\enums\CurrenciesEnum;
use app\enums\PaymentMethodsEnum;
use app\models\LootBox;
use app\models\Rating;
use app\widgets\comments\EntityComments;
use app\widgets\like\Like;

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
                    </div>
                    <div class="rating">
                        <?php if ($model->rating) : ?>
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <a href="javascript:void(0)"
                                   class="rate-it"
                                   data-rate="<?= $i ?>"
                                   data-id="<?= $model->id ?>" data-table="<?= $model->tableName() ?>">
                                    <i class="fa fa-star<?= ($i <= $model->rating->rate) ? '' : '-o' ?>"></i>
                                </a>
                            <?php endfor; ?>
                        <?php else: ?>
                            <a href="javascript:void(0)"
                               class="rate-it"
                               data-rate="1"
                               data-id="<?= $model->id ?>" data-table="<?= $model->tableName() ?>">
                                <i class="fa fa-star-o"></i>
                            </a>
                            <a href="javascript:void(0)"
                               class="rate-it"
                               data-rate="2"
                               data-id="<?= $model->id ?>" data-table="<?= $model->tableName() ?>">
                                <i class="fa fa-star-o"></i>
                            </a>
                            <a href="javascript:void(0)"
                               class="rate-it"
                               data-rate="3"
                               data-id="<?= $model->id ?>" data-table="<?= $model->tableName() ?>">
                                <i class="fa fa-star-o"></i>
                            </a>
                            <a href="javascript:void(0)"
                               class="rate-it"
                               data-rate="4"
                               data-id="<?= $model->id ?>" data-table="<?= $model->tableName() ?>">
                                <i class="fa fa-star-o"></i>
                            </a>
                            <a href="javascript:void(0)"
                               class="rate-it"
                               data-rate="5"
                               data-id="<?= $model->id ?>" data-table="<?= $model->tableName() ?>">
                                <i class="fa fa-star-o"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                    <p class="average-rate my-0">
                        Средняя оценка: <?= $model->counter->average_rating ?>
                    </p>
                    <p class="total-rates my-0">
                        Всего оценок: <?= $model->counter->ratings ?>
                    </p>
                    <p class="mb-3">
                        Игроков на нашем сайте: <?= $model->observers ? $model->observers->count : 0 ?>
                    </p>
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
