<?php

/* @var $model Casino */

use app\components\helpers\Url;
use app\models\Casino;
use app\widgets\comments\EntityComments;
use app\widgets\like\Like;
use app\widgets\rating\Rating;

$this->title = $model->name . ' - CSZilla';

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

                        <?php if (Yii::$app->usersService->isGranted(['ROLE_SUPER_ADMIN'])): ?>
                            <a class="text-white"
                               href="<?= Url::to(['/dashboard/casinos/update', 'id' => $model->id]) ?>">
                                <i class="fa fa-pencil"></i>
                            </a>
                        <?php endif; ?>
                    </div>

                    <?= Rating::widget(['model' => $model]) ?>

                    <?= $this->render('@app/modules/main/views/common/partner_counters', ['model' => $model]) ?>

                    <?= $model->description ?>

                    <?php if ($model->website): ?>
                        <a class="site-btn mb-3" target="_blank" href="<?= $model->website ?>">На сайт</a>
                    <?php endif; ?>
                </div>

                <?= $this->render('@app/modules/main/views/common/partner_pros', ['model' => $model]) ?>

                <div class="row mt-3">
                    <div class="col-6">
                        <?= $this->render('@app/modules/main/views/common/partner_currencies', ['model' => $model]) ?>
                    </div>
                    <div class="col-6">
                        <?= $this->render('@app/modules/main/views/common/partner_payment_methods', ['model' => $model]) ?>
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
