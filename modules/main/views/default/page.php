<?php

/* @var $model app\models\Page */
/* @var $pages app\models\Page[] */
/* @var $this yii\web\View */

use app\components\helpers\Url;

$this->title = $model->title . ' - CSZilla';
?>

<div class="nk-gap-2"></div>

<ul class="nk-breadcrumbs">
    <li><a href="<?= Url::to(['/main/default/index']) ?>">Главная</a></li>

    <li><span class="fa fa-angle-right"></span></li>

    <li><span><?= $model->title ?></span></li>
</ul>

<div class="nk-gap-2"></div>

<div class="row vertical-gap">
    <div class="col-lg-8 order-lg-2">
        <?= $model->content ?>
    </div>
    <div class="col-lg-4 nk-sidebar-sticky-parent">
        <aside class="nk-sidebar nk-sidebar-left nk-sidebar-sticky">
            <div>
                <div class="nk-widget nk-widget-highlighted">
                    <h4 class="nk-widget-title"><span><span class="text-main-1">Наши</span> страницы</span></h4>
                    <div class="nk-widget-content">
                        <ul class="nk-widget-categories">
                            <?php foreach ($pages as $page): ?>
                                <li>
                                    <a href="<?= Url::to(['/main/default/page', 'title_canonical' => $page->title_canonical]) ?>">
                                        <?= $page->title ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>
