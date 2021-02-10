<?php

use app\components\helpers\StringHelper;
use app\components\helpers\Url;
use app\models\GameMatch;
use app\widgets\comments\Comments;
use app\widgets\experts\Experts;
use app\widgets\pager\Pager;
use app\widgets\stream\Stream;
use app\widgets\videos\Videos;
use app\widgets\wallet\Wallet;
use yii\data\ActiveDataProvider;

/* @var $provider ActiveDataProvider */
/* @var $models GameMatch[] */
/* @var $this yii\web\View */
/* @var $state string */

$this->title = 'Матчи - CSZilla';

$models = $provider->getModels();

if (Yii::$app->request->get('state') == 'active') {
    $this->registerLinkTag([
        'rel' => 'canonical',
        'href' => Url::to(['/main/match-center/index'])
    ]);
}
?>

<div class="nk-gap-2"></div>

<ul class="nk-breadcrumbs">
    <li><a href="<?= Url::to(['/main/default/index']) ?>">Главная</a></li>

    <li><span class="fa fa-angle-right"></span></li>

    <li><span>Матчи</span></li>
</ul>

<div class="row vertical-gap">
    <div class="col-lg-8">
        <div class="nk-gap-2"></div>

        <div class="nk-tabs">
            <ul class="nav nav-tabs nav-tabs-fill" role="tablist">
                <li class="nav-item">
                    <a class="nav-link <?= $state == 'active' ? 'active' : '' ?>"
                       href="<?= Url::current(['state' => 'active']) ?>">
                        Актуальные
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $state == 'finished' ? 'active' : '' ?>"
                       href="<?= Url::current(['state' => 'finished']) ?>">
                        Прошедшие
                    </a>
                </li>
            </ul>
        </div>

        <div class="nk-gap-2"></div>

        <?php if (sizeof($models)): ?>
            <?php foreach ($models as $model): ?>
                <?= $this->render('_match_item', ['model' => $model]) ?>
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
            <?= Wallet::widget() ?>

            <?= Experts::widget() ?>

            <?= Videos::widget() ?>

            <?= Stream::widget() ?>

            <?= Comments::widget([
                'tableName' => GameMatch::tableName()
            ]) ?>
        </aside>
    </div>
</div>

<div class="nk-gap-2"></div>