<?php
/* @var $model Contest */

/* @var $this yii\web\View */

use app\components\helpers\StringHelper;
use app\components\helpers\Url;
use app\models\Contest;
use app\widgets\categories\Categories;
use app\widgets\comments\EntityComments;
use app\widgets\hot\Related;
use app\widgets\like\Like;

$this->title = 'Розыгрыш №' . $model->id . ' - CS:GO Heaven';

$this->render('@app/components/templates/meta', ['model' => $model]);
?>

<section class="blog-list-section py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 bordered-box text-break mx-3 mx-lg-0 mb-3 mb-lg-0">
                <div class="row">
                    <div class="col-auto ml-auto text-white-50">
                        <i class="fa fa-eye">
                            <span class="ml-1"><?= $model->counter->views ?></span>
                        </i>
                    </div>
                </div>
                <div class="blog-post single-post">
                    <div class="post-date"><?= StringHelper::humanize($model->ts) ?></div>
                    <div class="post-metas mb-0">
                        <?php if ($model->partner_type): ?>
                            <div class="post-meta">
                                <a href="<?= $model->getPartnerUrl() ?>">
                                    <?= $model->partner->name ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        <?php if (!$model->participant && !Yii::$app->user->isGuest && !$model->isActive() && $model->canParticipate()): ?>
                            <div class="post-meta" id="take-part">
                                <a class="take-part"
                                   data-contest="<?= $model->id ?>"
                                   href="javascript:void(0)">
                                    Участвовать
                                </a>
                            </div>
                        <?php endif; ?>
                        <div class="post-meta">
                            Участников: <span id="p-count"><?= sizeof($model->participants) ?></span>
                        </div>
                        <?php ?>
                    </div>
                    <?= $model->description ?>
                    <div class="row mt-3">
                        <div class="col-6">
                            <p class="mb-0">
                                Дата начала: <?= $model->date_start ?>
                            </p>
                        </div>
                        <div class="col-6">
                            <p class="mb-0">
                                Итоги: <?= $model->date_end ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="mt-5">
                    <?= Like::widget(['entity' => $model]) ?>
                </div>
            </div>
            <div class="col-lg-4 sidebar">
                <div class="sb-widget bordered-box">
                    <h2 class="sb-title mb-0">Призы</h2>
                    <hr/>
                    <?php if ($model->prizes): ?>
                        <?php foreach ($model->prizes as $prize): ?>
                            <div class="sb-item">
                                <img src="<?= $prize->image ?>">
                                <p><?= $prize->name ?></p>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Призы пока не определены</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?= EntityComments::widget([
    'entity' => $model
]) ?>
