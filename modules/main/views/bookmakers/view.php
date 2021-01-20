<?php

/* @var $model Bookmaker */

use app\components\helpers\Url;
use app\enums\CurrenciesEnum;
use app\enums\PaymentMethodsEnum;
use app\models\Bookmaker;
use app\widgets\comments\EntityComments;
use app\widgets\like\Like;
use app\widgets\rating\Rating;

$this->title = $model->name . ' - CSZilla';

$this->render('@app/components/templates/meta', ['model' => $model]);
?>

<section class="game-section character-one py-3">
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
                <div class="about-game">
                    <div class="game-title mb-0">
                        <img src="<?= $model->logo ?>" style="width: 15rem; height: auto" alt="<?= $model->name_canonical ?>">

                        <h2><?= $model->name ?></h2>

                        <?php if (Yii::$app->usersService->isGranted(['ROLE_SUPER_ADMIN'])): ?>
                            <a class="text-white"
                               href="<?= Url::to(['/dashboard/bookmakers/update', 'id' => $model->id]) ?>">
                                <i class="fa fa-pencil"></i>
                            </a>
                        <?php endif; ?>

                    </div>

                    <?= Rating::widget(['model' => $model]) ?>

                    <?= $this->render('@app/modules/main/views/common/partner_counters', ['model' => $model]) ?>

                    <?= $model->description ?>

                    <div class="my-3">
                        <?php if ($model->website): ?>
                            <a class="site-btn mb-3" target="_blank" href="<?= $model->website ?>">Перейти</a>
                        <?php endif; ?>

                        <?php if ($model->android_app): ?>
                            <a class="site-btn mb-3" target="_blank" href="<?= $model->android_app ?>">Установить
                                <i class="fa fa-android"></i>
                            </a>
                        <?php endif; ?>

                        <?php if ($model->ios_app): ?>
                            <a class="site-btn mb-3" target="_blank" href="<?= $model->ios_app ?>">Установить
                                <i class="fa fa-apple"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>

                <?= $this->render('@app/modules/main/views/common/partner_pros', ['model' => $model]) ?>

                <div class="row mt-3">
                    <div class="col-6">
                        <p class="mb-0">Live: <i class="fa fa-<?= $model->has_live_mode ? 'check' : 'times' ?>-circle"></i></p>
                        <p class="mb-0">Лицензия: <i class="fa fa-<?= $model->has_license ? 'check' : 'times' ?>-circle"></i></p>
                        <p class="mb-0">ЦУПИС: <i class="fa fa-<?= $model->cupis ? 'check' : 'times' ?>-circle"></i></p>
                    </div>

                    <div class="col-6">
                        <?= $this->render('@app/modules/main/views/common/partner_currencies', ['model' => $model]) ?>

                        <?= $this->render('@app/modules/main/views/common/partner_payment_methods', ['model' => $model]) ?>

                        <p class="mb-0">
                            Маржа: <?= $model->margin ?>
                        </p>
                    </div>
                </div>

                <div class="mt-5">
                    <?= Like::widget(['entity' => $model]) ?>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="sb-widget bordered-box">
                    <h4 class="text-white mb-3">Бонусы</h4>
                    <?php if (sizeof($model->bonuses)): ?>
                        <div class="latest-news-widget">
                            <?php foreach ($model->bonuses as $bonus): ?>
                                <hr/>
                                <div class="ln-item">
                                    <div class="ln-text">
                                        <?= $bonus->description ?>
                                        <div class="ln-metas">
                                            <div class="ln-meta">
                                                <a target="_blank" href="<?= $bonus->url ?>">
                                                    <i class="fa fa-gift"></i>
                                                    <?= $bonus->amount ?><?= CurrenciesEnum::font($bonus->currency) ?>
                                                </a>
                                            </div>
                                            <div class="ln-meta">
                                                <a href="<?= Url::to(['/main/bonuses/view', 'id' => $bonus->id]) ?>">Подробнее</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p>
                            Бонусов пока нет.
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
