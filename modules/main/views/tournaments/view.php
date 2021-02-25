<?php

/** @var $this yii\web\View */
/** @var $bracket app\forms\TournamentBracketForm */
/** @var $model app\models\Tournament */
/** @var $form */

use app\components\helpers\StringHelper;
use app\components\helpers\Url;
use app\enums\TournamentFormatEnum;
use app\widgets\comments\EntityComments;
use app\widgets\like\Like;
use yii\bootstrap4\Modal;

$this->title = 'Турнир формата ' . TournamentFormatEnum::label($model->format) . ' #' . $model->serial_number;
?>


<div class="nk-gap-2"></div>

<ul class="nk-breadcrumbs">
    <li><a href="<?= Url::to(['/main/default/index']) ?>">Главная</a></li>

    <li><span class="fa fa-angle-right"></span></li>

    <li><a href="<?= Url::to(['/main/tournaments/index']) ?>">Турниры</a></li>

    <li><span class="fa fa-angle-right"></span></li>

    <li>
        <span><?= $this->title ?></span>
    </li>
</ul>

<div class="row vertical-gap">
    <div class="col-lg-8">
        <div class="nk-tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active show" href="#tab-description" role="tab" data-toggle="tab">Описание</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#tab-teams" role="tab" data-toggle="tab">Участники</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#tab-net" role="tab" data-toggle="tab">Сетка</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#tab-conversation" role="tab" data-toggle="tab">Обсуждение</a>
                </li>
            </ul>

            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade active show" id="tab-description">
                    <div class="nk-blog-post nk-blog-post-single">
                        <div class="nk-gap-2"></div>

                        <div class="nk-post-text mt-0 position-relative">
                            <div class="w-100 text-right pr-10">
                                <span class="nk-color-dark-3"><i
                                            class="fa fa-eye pr-3"></i><?= $model->counter->views ?></span>
                            </div>

                            <div class="nk-gap-2"></div>

                            <h3 class="h4">Регламент</h3>
                            <p>
                                <?= nl2br($model->regulations) ?>
                            </p>

                            <h3 class="h4">Призовой фонд</h3>
                            <p>
                                <?= nl2br($model->prize_pool) ?>
                            </p>

                            <h3 class="h4">Начало</h3>
                            <p><?= StringHelper::humanize($model->date_start, true, false) ?></p>

                            <div class="nk-gap-4"></div>

                            <?= Like::widget(['entity' => $model]) ?>
                        </div>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="tab-conversation">
                    <div class="nk-gap-2"></div>
                    <?= EntityComments::widget(['entity' => $model]) ?>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="tab-teams">
                    <div class="nk-gap-2"></div>
                    <div class="row">
                        <?= $this->render($bracket->getParticipantsTemplate(), ['models' => $bracket->getParticipants()]) ?>

                        <?php if ($bracket->canRegister()): ?>
                            <div class="col-md-4">
                                <div class="nk-box-2 bg-dark-2 p-20">
                                    <a href="#" data-toggle="modal" data-target="#participate" rel="nofollow">
                                        <h4 class="mb-0">Участвовать</h4>
                                    </a>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <div role="tabpanel" class="tab-pane fade" id="tab-net">
                    <div class="nk-gap-2"></div>
                </div>

            </div>
        </div>

    </div>

    <div class="col-lg-4">
        <aside class="nk-sidebar nk-sidebar-right nk-sidebar-sticky">
            <div class="nk-gap-2"></div>
            <?php if ($model->show_stream): ?>
                <div class="nk-widget nk-widget-highlighted">
                    <h4 class="nk-widget-title"><span><span class="text-main-1">Трансляция</span> турнира</span></h4>
                    <div id="stream" class="nk-widget-content">

                    </div>
                </div>
            <?php endif; ?>
        </aside>
    </div>
</div>

<?php Modal::begin([
    'id' => 'participate',
    'title' => 'Принять участие'
]); ?>
    <?= $this->render($bracket->getRegisterFormTemplate(), ['model' => $form]) ?>
<?php Modal::end(); ?>
