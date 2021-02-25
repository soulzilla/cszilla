<?php

use app\components\helpers\Url;
use app\enums\TournamentFormatEnum;
use app\models\Tournament;
use app\widgets\comments\Comments;
use app\widgets\pager\Pager;
use app\widgets\stream\Stream;
use app\widgets\videos\Videos;
use yii\data\ActiveDataProvider;

/* @var $provider ActiveDataProvider */
/* @var $models Tournament[] */
/* @var $this yii\web\View */
/* @var $state string */

$this->title = 'Турниры - CSZilla';

$models = $provider->getModels();

if (Yii::$app->request->get('state') == 'active') {
    $this->registerLinkTag([
        'rel' => 'canonical',
        'href' => Url::to(['/main/tournaments/index'])
    ]);
}
?>

<div class="nk-gap-2"></div>

<ul class="nk-breadcrumbs">
    <li><a href="<?= Url::to(['/main/default/index']) ?>">Главная</a></li>

    <li><span class="fa fa-angle-right"></span></li>

    <li><span>Турниры</span></li>
</ul>

<div class="row vertical-gap">
    <div class="col-lg-8">
        <div class="nk-gap-2"></div>

        <div class="nk-tabs">
            <ul class="nav nav-tabs nav-tabs-fill" role="tablist">
                <li class="nav-item">
                    <a class="nav-link <?= $state == 'active' ? 'active' : '' ?>"
                       href="<?= Url::to(['/main/tournaments/index', 'state' => 'active']) ?>">
                        Актуальные
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $state == 'finished' ? 'active' : '' ?>"
                       href="<?= Url::to(['/main/tournaments/index', 'state' => 'finished']) ?>">
                        Прошедшие
                    </a>
                </li>
            </ul>
        </div>

        <div class="nk-gap-2"></div>

        <?php if (sizeof($models)): ?>
            <?php foreach ($models as $model): ?>
                <a href="<?= Url::to(['/main/tournaments/view', 'id' => $model->id]) ?>">
                    <div class="nk-feature-2">
                        <div class="nk-feature-icon">
                            <span class="<?= TournamentFormatEnum::icon($model->format) ?>"></span>
                        </div>
                        <h3 class="nk-feature-title">
                            Турнир формата <span class="text-main-1">"<?= TournamentFormatEnum::label($model->format) ?>"</span> #<?= $model->serial_number ?>
                        </h3>
                    </div>
                </a>
            <?php endforeach; ?>

            <div class="nk-gap-2"></div>
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
            <?= Videos::widget() ?>

            <?= Stream::widget() ?>

            <?= Comments::widget([
                'tableName' => Tournament::tableName()
            ]) ?>
        </aside>
    </div>
</div>

<div class="nk-gap-2"></div>
