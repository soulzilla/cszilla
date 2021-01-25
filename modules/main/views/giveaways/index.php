<?php

/* @var $this yii\web\View */

use app\components\helpers\StringHelper;
use app\components\helpers\Url;
use app\widgets\banners\Banners;
use app\widgets\comments\Comments;
use app\widgets\pager\Pager;
use app\widgets\stream\Stream;
use app\widgets\videos\Videos;

/* @var $provider yii\data\ActiveDataProvider */
/* @var $models app\models\Contest[] */

$this->title = 'Розыгрыши на сайте CSZilla';

$models = $provider->getModels();

$this->render('@app/components/templates/meta');
?>

<?= Banners::widget() ?>

<div class="nk-gap-2"></div>

<ul class="nk-breadcrumbs">
    <li><a href="<?= Url::to(['/main/default/index']) ?>">Главная</a></li>

    <li><span class="fa fa-angle-right"></span></li>

    <li><span>Розыгрыши</span></li>
</ul>

<div class="row vertical-gap">
    <div class="col-lg-8">
        <div class="nk-gap-2"></div>

        <?php if (sizeof($models)): ?>
            <?php foreach ($models as $model): ?>
                <div class="nk-blog-post nk-blog-post-border-bottom">
                    <h2 class="nk-post-title h4">
                        <a href="<?= Url::to(['/main/giveaways/view', 'id' => $model->id]) ?>">
                            Розыгрыш - <?= StringHelper::humanize($model->date_start, true) ?>
                        </a>
                    </h2>

                    <div class="nk-post-date mt-10 mb-10">
                        <span class="fa fa-calendar"></span> <?= StringHelper::humanize($model->ts) ?>
                    </div>

                    <div class="nk-post-text">
                        <p><?= $model->description ?></p>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="nk-pagination nk-pagination-center">
                <?= Pager::widget([
                    'pagination' => $provider->pagination
                ]) ?>
            </div>

            <div class="nk-gap"></div>

        <?php endif; ?>
    </div>

    <div class="col-lg-4">
        <aside class="nk-sidebar nk-sidebar-right nk-sidebar-sticky">
            <div class="nk-gap-2"></div>

            <?= Videos::widget() ?>

            <?= Stream::widget() ?>

            <?= Comments::widget() ?>
        </aside>
    </div>
</div>

<div class="nk-gap-2"></div>

<section class="page-top-section set-bg" data-setbg="/images/give_bg.jpg">
    <div class="container">
        <h2>Розыгрыши</h2>
    </div>
</section>

<section class="blog-list-section pt-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 bordered-box mb-3 mx-3 mx-lg-0 text-break">
                <div class="small-blog-list">
                    <?php if (sizeof($models)): $lastKey = array_key_last($models); ?>
                        <?php foreach ($models as $key => $model): ?>
                            <div class="sb-item">
                                <div class="sb-text">

                                    <a href="<?= Url::to(['/main/giveaways/view', 'id' => $model->id]) ?>">
                                        <h6>Розыгрыш - <?= StringHelper::humanize($model->date_start) ?></h6>
                                    </a>

                                    <?= $model->description ?>
                                </div>
                            </div>
                            <?php if ($key != $lastKey): ?>
                                <hr/>
                            <?php endif; ?>

                        <?php endforeach; ?>

                        <?= Pager::widget([
                            'pagination' => $provider->pagination
                        ]) ?>
                    <?php else: ?>
                        <p>
                            Розыгрыши недоступны
                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-4 mb-3">
            </div>
        </div>
    </div>
</section>
