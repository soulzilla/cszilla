<?php
/* @var $model Contest */

/* @var $this yii\web\View */

use app\components\helpers\StringHelper;
use app\components\helpers\Url;
use app\models\Contest;
use app\widgets\alert\Alert;
use app\widgets\comments\EntityComments;
use app\widgets\like\Like;
use app\widgets\stream\Stream;
use app\widgets\videos\Videos;

$this->title = 'Розыгрыш №' . $model->id . ' - CSZilla';

$this->render('@app/components/templates/meta', ['model' => $model]);
?>

<div class="nk-gap-2"></div>

<ul class="nk-breadcrumbs">
    <li><a href="<?= Url::to(['/main/default/index']) ?>">Главная</a></li>

    <li><span class="fa fa-angle-right"></span></li>

    <li><a href="<?= Url::to(['/main/giveaways/index']) ?>">Розыгрыши</a></li>

    <li><span class="fa fa-angle-right"></span></li>

    <li><span><?= $this->title ?></span></li>
</ul>

<div class="row vertical-gap">
    <div class="col-lg-8">

        <div class="nk-blog-post nk-blog-post-single">
            <div class="nk-gap-2"></div>

            <?= Alert::widget() ?>

            <div class="nk-post-text mt-0 nk-info-box pl-30 pr-10">
                <div class="nk-post-categories">
                    <span class="nk-color-dark-3"><i class="fa fa-eye pr-3"></i><?= $model->counter->views ?></span>
                </div>
                <h1 class="nk-post-title h4">Розыгрыш от <?= StringHelper::humanize($model->date_start, true, false) ?></h1>
                <div class="nk-post-date"><span class="fa fa-calendar"></span><?= StringHelper::humanize($model->ts) ?></div>

                <div class="nk-gap"></div>

                <?= $model->description ?>

                <div class="nk-gap-4"></div>

                <?= Like::widget(['entity' => $model]) ?>
            </div>
        </div>

        <?php if ($model->prizes): ?>
            <h3 class="nk-decorated-h-2"><span class="text-main-1">Призы</span></h3>
            <div class="nk-gap"></div>
            <div class="row vertical-gap">
                <?php foreach ($model->prizes as $prize): ?>
                    <div class="col-md-6">
                        <div class="nk-product-cat">
                            <a class="nk-product-image">
                                <img src="<?= $prize->image ?>" alt="<?= $prize->name ?>">
                            </a>
                            <div class="nk-product-cont">
                                <h3 class="nk-product-title h5"><?= $prize->name ?></h3>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="nk-gap"></div>
        <?php endif; ?>

        <?php if ($model->isActive()): ?>
            <div class="nk-gap-2"></div>
            <h3 class="nk-decorated-h-2"><span><span class="text-main-1">Результаты</span> через</span></h3>
            <div class="nk-countdown nk-countdown-center" data-end="<?= $model->date_end ?>" data-timezone="<?= Yii::$app->timeZone ?>"></div>
            <div class="nk-gap"></div>

            <?php if ($model->canParticipate()): ?>
                <div class="text-center p-30">
                    <a href="<?= Url::to(['/main/giveaways/participate', 'id' => $model->id]) ?>" data-method="post"
                       class="nk-btn nk-btn-color-main-1 nk-btn-rounded">Участвовать</a>
                </div>
            <?php endif; ?>

            <div class="nk-gap"></div>
        <?php endif; ?>

        <?= EntityComments::widget([
            'entity' => $model
        ]) ?>

    </div>

    <div class="col-lg-4">
        <aside class="nk-sidebar nk-sidebar-right nk-sidebar-sticky">
            <div class="nk-gap-2"></div>

            <?= Videos::widget() ?>

            <?= Stream::widget() ?>
        </aside>
    </div>
</div>

<div class="nk-gap-2"></div>
