<?php

/* @var $provider ActiveDataProvider */
/* @var $models Publication[] */
/* @var $categories app\models\Category[]|null */
/* @var $this yii\web\View */

/* @var $current string */

use app\components\helpers\{StringHelper, Url};
use app\models\Publication;
use app\widgets\{comments\Comments, pager\Pager, stream\Stream, videos\Videos};
use yii\data\ActiveDataProvider;

$this->title = 'Новости - CSZilla';
if ($current) {
    $this->registerLinkTag([
        'rel' => 'canonical',
        'href' => Url::to(['/main/news/index'], 'https')
    ]);
}

$models = $provider->getModels();
?>
<div class="nk-gap-2"></div>

<ul class="nk-breadcrumbs">
    <li><a href="<?= Url::to(['/main/default/index']) ?>">Главная</a></li>

    <li><span class="fa fa-angle-right"></span></li>

    <li><span>Новости</span></li>
</ul>

<div class="row vertical-gap">
    <div class="col-lg-8">
        <?php if (sizeof($categories)): ?>
            <div class="nk-gap-2"></div>

            <div class="nk-tabs">
                <ul class="nav nav-tabs nav-tabs-fill" role="tablist">
                    <?php foreach ($categories as $category): ?>
                        <li class="nav-item">
                            <a class="nav-link <?= ($current && $category->name_canonical == $current) ? 'active' : '' ?>"
                               href="<?= Url::current(['category' => $category->name_canonical]) ?>">
                                <?= $category->name ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="nk-gap-2"></div>
        <?php endif; ?>

        <?php if (sizeof($models)): ?>
            <?php foreach ($models as $model): ?>
                <div class="nk-blog-post nk-blog-post-border-bottom">
                    <span class="nk-post-categories">
                        <span class="<?= $model->category->color ?>"><?= $model->category->name ?></span>
                    </span>

                    <div class="nk-gap-1"></div>

                    <h2 class="nk-post-title h4">
                        <a href="<?= Url::to(['/main/news/view', 'title_canonical' => $model->title_canonical]) ?>">
                            <?= $model->title ?>
                        </a>
                    </h2>

                    <div class="nk-post-date mt-10 mb-10">
                        <span class="fa fa-calendar"></span> <?= StringHelper::humanize($model->publish_date) ?>
                        <span class="fa fa-pencil" title="Автор"></span><?= $model->author->name ?>
                    </div>

                    <div class="nk-post-text">
                        <p><?= $model->announce ?></p>
                    </div>
                </div>
            <?php endforeach; ?>

            <div class="nk-pagination nk-pagination-center">
                <?= Pager::widget([
                    'pagination' => $provider->pagination
                ]) ?>
            </div>

        <?php endif; ?>
    </div>

    <div class="col-lg-4">
        <aside class="nk-sidebar nk-sidebar-right nk-sidebar-sticky">
            <div class="nk-gap-2"></div>

        </aside>
    </div>
</div>

<div class="nk-gap-2"></div>