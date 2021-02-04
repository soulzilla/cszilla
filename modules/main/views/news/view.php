<?php
/* @var $model Publication */

/* @var $this yii\web\View */

use app\components\helpers\{StringHelper, Url};
use app\models\Publication;
use app\widgets\{hot\Related, like\Like, comments\EntityComments, stream\Stream, videos\Videos};

$this->title = $model->title . ' - CSZilla';
?>

<div class="nk-gap-2"></div>

<ul class="nk-breadcrumbs">
    <li><a href="<?= Url::to(['/main/default/index']) ?>">Главная</a></li>

    <li><span class="fa fa-angle-right"></span></li>

    <li><a href="<?= Url::to(['/main/news/index']) ?>">Новости</a></li>

    <li><span class="fa fa-angle-right"></span></li>

    <li><span><?= $model->title ?></span></li>
</ul>

<div class="row vertical-gap">
    <div class="col-lg-8">

        <div class="nk-blog-post nk-blog-post-single">
            <div class="nk-gap-2"></div>


            <div class="nk-post-text mt-0 nk-info-box pl-30 pr-10">
                <div class="nk-post-categories">
                    <span class="nk-color-dark-3"><i class="fa fa-eye pr-3"></i><?= $model->counter->views ?></span>
                </div>
                <h1 class="nk-post-title h4"><?= $model->title ?></h1>
                <div class="nk-post-date"><span
                            class="fa fa-calendar"></span><?= StringHelper::humanize($model->publish_date) ?></div>
                <div class="nk-post-by">
                    <a class="nk-btn nk-btn-rounded nk-btn-color-main-1" href="javascript:void(0)"
                       rel="nofollow"><?= $model->author->name ?></a>

                    <a class="nk-btn nk-btn-rounded nk-btn-color-main-1 <?= $model->category->color ?>"
                       href="javascript:void(0)" rel="nofollow"><?= $model->category->name ?></a>
                </div>

                <div class="nk-gap"></div>

                <?= $model->body ?>

                <div class="nk-gap-4"></div>

                <?= Like::widget(['entity' => $model]) ?>
            </div>
        </div>

        <?= $this->render('@app/modules/main/views/common/popup_gallery', ['model' => $model]) ?>

        <?= EntityComments::widget([
            'entity' => $model
        ]) ?>

    </div>

    <div class="col-lg-4">
        <aside class="nk-sidebar nk-sidebar-right nk-sidebar-sticky">
            <div class="nk-gap-2"></div>

            <?= Videos::widget() ?>

            <?= Stream::widget() ?>

            <?= Related::widget(['currentPublication' => $model]) ?>
        </aside>
    </div>
</div>

<div class="nk-gap-2"></div>
