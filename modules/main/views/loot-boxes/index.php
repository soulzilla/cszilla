<?php

use app\components\helpers\Url;
use app\models\LootBox;
use app\widgets\banners\Banners;
use app\widgets\comments\Complaints;
use app\widgets\comments\Overviews;
use yii\bootstrap4\Html;
use yii\data\ActiveDataProvider;

/* @var $provider ActiveDataProvider */
/* @var $models LootBox[] */

$this->title = 'Лутбоксы - CS:GO Heaven';
$models = $provider->getModels();
?>
<section class="page-top-section set-bg" data-setbg="/images/lb_bg.jpg">
    <div class="container">
        <h2>Лутбоксы</h2>
    </div>
</section>

<section class="blog-list-section pt-3 min-h-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 bordered-box text-break mb-3 mx-3 mx-lg-0" style="max-width: 90%;">
                <div class="small-blog-list">
                    <?php if (sizeof($models)): ?>
                        <?php foreach ($models as $key => $model): ?>
                            <div class="sb-item">
                                <img src="<?= $model->logo ?>" alt="<?= $model->name_canonical ?>">
                                <div class="sb-text">
                                    <h6><?= $model->name ?></h6>
                                    <div class="sb-metas">
                                        <div class="sb-meta">
                                            <a href="<?= Url::to(['/main/loot-boxes/view', 'name_canonical' => $model->name_canonical]) ?>">
                                                Подробнее
                                            </a>
                                        </div>
                                        <?php if ($model->promoCode): ?>
                                            <div class="sb-meta">
                                                <a href="<?= Url::to(['/main/promos/view', 'id' => $model->promoCode->id]) ?>">
                                                    Получить бонус
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
                            Список сайтов с лутбоксами недоступен
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

<?php if (sizeof($models)): ?>
<section class="testimonials-section pt-0 pb-3">
    <div class="container pl-3 pl-lg-0">
        <div class="bordered-box text-white">
            <div class="row pt-5 mt-5 mt-lg-0">
                <div class="col-3">
                </div>
                <div class="col-1 vertical-text px-0" style="color: #4b69ff">
                    Армейский
                </div>
                <div class="col-1 vertical-text px-0" style="color: #8847ff">
                    Запрещённый
                </div>
                <div class="col-1 vertical-text px-0" style="color: #d32ee6">
                    Засекреченный
                </div>
                <div class="col-1 vertical-text px-0" style="color: #eb4b4b">
                    Тайный
                </div>
                <div class="col-1 vertical-text px-0" style="color: gold">
                    Ножевой
                </div>
                <div class="col-1 vertical-text px-0" style="color: gold">
                    Перчаточный
                </div>
                <div class="col-1 vertical-text px-0" style="color: gold">
                    Топовый
                </div>
            </div>

            <?php foreach ($models as $model): ?>
                <div class="row pt-0 pt-lg-5">
                    <div class="col-3 px-0 px-lg-3">
                        <?= Html::a($model->name, ['view', 'name_canonical' => $model->name_canonical]) ?>
                    </div>
                    <div class="col-1">
                        <div class="row">
                            <div class="col-6 border-right">
                                <?= $model->boxes->military_cost ?>
                            </div>
                            <div class="col-6">
                                <?= $model->boxes->military_average ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="row">
                            <div class="col-6 border-right">
                                <?= $model->boxes->restricted_cost ?>
                            </div>
                            <div class="col-6">
                                <?= $model->boxes->restricted_average ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="row">
                            <div class="col-6 border-right">
                                <?= $model->boxes->classified_cost ?>
                            </div>
                            <div class="col-6">
                                <?= $model->boxes->classified_average ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="row">
                            <div class="col-6 border-right">
                                <?= $model->boxes->covert_cost ?>
                            </div>
                            <div class="col-6">
                                <?= $model->boxes->covert_average ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="row">
                            <div class="col-6 border-right">
                                <?= $model->boxes->knife_cost ?>
                            </div>
                            <div class="col-6">
                                <?= $model->boxes->knife_average ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="row">
                            <div class="col-6 border-right">
                                <?= $model->boxes->gloves_cost ?>
                            </div>
                            <div class="col-6">
                                <?= $model->boxes->gloves_average ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="row">
                            <div class="col-6 border-right">
                                <?= $model->boxes->top_cost ?>
                            </div>
                            <div class="col-6">
                                <?= $model->boxes->top_average ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="testimonials-section pt-0 pb-3">
    <div class="container pl-3 pl-lg-0">
        <div class="bordered-box text-white">
            <div class="row pt-3 pt-lg-0">
                <div class="col-3">

                </div>
                <div class="col-1 px-0 vertical-text">
                    USP
                </div>
                <div class="col-1 px-0 vertical-text">
                    Glock
                </div>
                <div class="col-1 px-0 vertical-text">
                    AK
                </div>
                <div class="col-1 px-0 vertical-text">
                    M4A1
                </div>
                <div class="col-1 px-0 vertical-text">
                    M4A4
                </div>
                <div class="col-1 px-0 vertical-text">
                    Deagle
                </div>
                <div class="col-1 px-0 vertical-text">
                    AWP
                </div>
            </div>

            <?php foreach ($models as $model): ?>
                <div class="row pt-5">
                    <div class="col-3 px-0 px-lg-3">
                        <?= Html::a($model->name, ['view', 'name_canonical' => $model->name_canonical]) ?>
                    </div>
                    <div class="col-1">
                        <div class="row">
                            <div class="col-6 border-right">
                                <?= $model->boxes->usp_cost ?>
                            </div>
                            <div class="col-6">
                                <?= $model->boxes->usp_average ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="row">
                            <div class="col-6 border-right">
                                <?= $model->boxes->gloves_cost ?>
                            </div>
                            <div class="col-6">
                                <?= $model->boxes->glock_average ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="row">
                            <div class="col-6 border-right">
                                <?= $model->boxes->ak_cost ?>
                            </div>
                            <div class="col-6">
                                <?= $model->boxes->ak_average ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="row">
                            <div class="col-6 border-right">
                                <?= $model->boxes->m4a1_cost ?>
                            </div>
                            <div class="col-6">
                                <?= $model->boxes->m4a1_average ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="row">
                            <div class="col-6 border-right">
                                <?= $model->boxes->m4a4_cost ?>
                            </div>
                            <div class="col-6">
                                <?= $model->boxes->m4a4_average ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="row">
                            <div class="col-6 border-right">
                                <?= $model->boxes->deagle_cost ?>
                            </div>
                            <div class="col-6">
                                <?= $model->boxes->deagle_average ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-1">
                        <div class="row">
                            <div class="col-6 border-right">
                                <?= $model->boxes->awp_cost ?>
                            </div>
                            <div class="col-6">
                                <?= $model->boxes->awp_average ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>
