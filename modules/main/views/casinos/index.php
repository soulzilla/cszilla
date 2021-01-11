<?php

use app\components\helpers\Url;
use app\models\Casino;
use app\widgets\banners\Banners;
use app\widgets\comments\Complaints;
use app\widgets\comments\Overviews;
use yii\data\ActiveDataProvider;

/* @var $provider ActiveDataProvider */
/* @var $models Casino[] */

$this->title = 'Казино - CS:GO Heaven';
$models = $provider->getModels();
?>
<section class="page-top-section set-bg" data-setbg="/images/casino_bg.jpg">
    <div class="container">
        <h2>Казино</h2>
    </div>
</section>

<section class="blog-list-section pt-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 bordered-box text-break mb-3 mx-3 mx-lg-0">
                <div class="small-blog-list">
                    <?php if (sizeof($models)): ?>
                        <?php foreach ($models as $key => $model): ?>
                            <div class="sb-item">
                                <img src="<?= $model->logo ?>" alt="<?= $model->name_canonical ?>">
                                <div class="sb-text">
                                    <h6><?= $model->name ?></h6>
                                    <div class="sb-metas">
                                        <div class="sb-meta">
                                            <a href="<?= Url::to(['/main/casinos/view', 'name_canonical' => $model->name_canonical]) ?>">
                                                Подробнее
                                            </a>
                                        </div>
                                        <?php if ($model->promoCode): ?>
                                            <div class="sb-meta">
                                                <a href="<?= Url::to(['/main/promos/view', 'id' => $model->promoCode->id]) ?>">
                                                    Промокод
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <div class="sb-meta">
                                            <a href="#" data-toggle="modal" data-target="#overview-modal-<?= $model->id ?>">Написать обзор</a>
                                        </div>
                                        <div class="sb-meta">
                                            <a href="#" data-toggle="modal" data-target="#complaint-modal-<?= $model->id ?>">Написать жалобу</a>
                                        </div>
                                    </div>
                                    <?= $model->description ?>
                                    <?= Overviews::widget(['entity' => $model]) ?>
                                    <?= Complaints::widget(['entity' => $model]) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>
                            Список казино недоступен
                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-4 mb-3">
                <?= Banners::widget() ?>
            </div>
        </div>
    </div>
</section>
