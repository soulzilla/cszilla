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
