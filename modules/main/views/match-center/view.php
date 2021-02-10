<?php
/* @var $model GameMatch */

/* @var $this yii\web\View */

use app\components\helpers\{StringHelper, Url};
use app\models\GameMatch;
use app\widgets\{experts\Experts,
    hot\Related,
    like\Like,
    comments\EntityComments,
    stream\Stream,
    videos\Videos,
    wallet\Wallet};

$this->title = $model->firstTeam->name . ' - ' . $model->secondTeam->name . ' ' . StringHelper::humanize($model->start_ts, true) . ' - CSZilla';
?>

<div class="nk-gap-2"></div>

<ul class="nk-breadcrumbs">
    <li><a href="<?= Url::to(['/main/default/index']) ?>">Главная</a></li>

    <li><span class="fa fa-angle-right"></span></li>

    <li><a href="<?= Url::to(['/main/match-center/index']) ?>">Матчи</a></li>

    <li><span class="fa fa-angle-right"></span></li>

    <li>
        <span><?= $model->firstTeam->name . ' - ' . $model->secondTeam->name . ' ' . StringHelper::humanize($model->start_ts, true) ?></span>
    </li>
</ul>

<div class="row vertical-gap">
    <div class="col-lg-8">

        <div class="nk-blog-post nk-blog-post-single">
            <div class="nk-gap-2"></div>

            <div class="nk-post-text mt-0 position-relative">
                <div class="w-100 text-right pr-10">
                    <span class="nk-color-dark-3"><i class="fa fa-eye pr-3"></i><?= $model->counter->views ?></span>
                </div>

                <?= $this->render('_match_item', ['model' => $model]) ?>

                <div class="nk-gap-4"></div>

                <?= Like::widget(['entity' => $model]) ?>
            </div>
        </div>

        <?= EntityComments::widget([
            'entity' => $model
        ]) ?>

    </div>

    <div class="col-lg-4">
        <aside class="nk-sidebar nk-sidebar-right nk-sidebar-sticky">
            <div class="nk-gap-2"></div>
            <?= Wallet::widget() ?>

            <?= Experts::widget() ?>

            <?= Videos::widget() ?>

            <?= Stream::widget() ?>
        </aside>
    </div>
</div>

<div class="nk-gap-2"></div>
