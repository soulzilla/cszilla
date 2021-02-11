<?php

/* @var $models Faq[] */
/* @var $this yii\web\View */
/* @var $tab string */

use app\components\helpers\Url;
use app\enums\FaqCategoriesEnum;
use app\models\Faq;
use app\widgets\stream\Stream;
use app\widgets\videos\Videos;

$this->title = 'Часто задаваемые вопросы - CSZilla';

if (Yii::$app->request->get('tab')) {
    $this->registerLinkTag([
        'rel' => 'canonical',
        'href' => Url::to(['/main/faq/index'])
    ]);
}
?>

<div class="nk-gap-2"></div>

<ul class="nk-breadcrumbs">
    <li><a href="<?= Url::to(['/main/default/index']) ?>">Главная</a></li>

    <li><span class="fa fa-angle-right"></span></li>

    <li><span>FAQ</span></li>
</ul>

<div class="row vertical-gap">
    <div class="col-lg-8">
        <div class="nk-gap-2"></div>

        <div class="nk-tabs">
            <ul class="nav nav-tabs nav-tabs-fill" role="tablist">
                <?php foreach (FaqCategoriesEnum::labels() as $key => $label): ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $tab == $key ? 'active' : '' ?>"
                           href="<?= Url::current(['tab' => $key]) ?>">
                            <?= $label ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div class="nk-gap-2"></div>

        <?php if (sizeof($models)): ?>
            <div class="nk-accordion" id="questions-accordion" role="tablist" aria-multiselectable="true">
                <?php foreach ($models as $model): ?>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="questions-accordion-<?= $model->id ?>-heading">
                            <a class="collapsed" data-toggle="collapse" data-parent="#questions-accordion" href="#questions-accordion-<?= $model->id ?>" aria-expanded="true" aria-controls="questions-accordion-<?= $model->id ?>">
                                <?= $model->order ?>. <?= $model->question ?> <span class="panel-heading-arrow fa fa-angle-down"></span>
                            </a>
                        </div>
                        <div id="questions-accordion-<?= $model->id ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="questions-accordion-<?= $model->id ?>-heading">
                            <p><?= nl2br($model->answer) ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
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