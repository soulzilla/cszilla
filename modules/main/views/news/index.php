<?php

/* @var $provider ActiveDataProvider */
/* @var $models Publication[] */

use app\components\helpers\{StringHelper, Url};
use app\enums\StaticBlockEnum;
use app\models\Publication;
use app\widgets\{categories\Categories, pager\Pager, stream\Stream, videos\Videos};
use yii\data\ActiveDataProvider;

$this->title = 'Новости CS:GO Heaven';

$models = $provider->getModels();
?>

<section class="blog-list-section spad pb-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 bordered-box">
                <div class="blog-post featured-post">
                    <h2 class="text-white mb-3">Новости</h2>
                    <?= Yii::$app->staticBlocksService->getNewsDescription()->content; ?>
                    <?php if (Yii::$app->usersService->isGranted(['ROLE_SUPER_ADMIN'])): ?>
                        <a href="<?= Url::to(['/dashboard/static/update', 'type' => StaticBlockEnum::TYPE_NEWS_DESCRIPTION]) ?>" class="text-white">
                            <i class="fa fa-pencil"></i>
                        </a>
                    <?php endif; ?>
                </div>
                <h3 class="text-white mb-3">Публикации</h3>
                <?php if (sizeof($models)): ?>
                    <div class="row">
                        <?php foreach ($models as $model): ?>
                            <div class="col-md-6">
                                <div class="blog-post">
                                    <h4><?= $model->title ?></h4>
                                    <div class="post-date" style="background-color: <?= $model->category->color ?>">
                                        <?= StringHelper::humanize($model->publish_date) ?>
                                    </div>
                                    <div class="post-metas">
                                        <div class="post-meta">
                                            <a href="<?= Url::to(['/main/news/index', 'category' => $model->category->id]) ?>">
                                                <?= $model->category->name ?>
                                            </a>
                                        </div>
                                        <div class="post-meta"><?= $model->author->name ?></div>
                                    </div>
                                    <p><?= $model->announce ?></p>
                                    <a href="<?= Url::to(['/main/news/view', 'title_canonical' => $model->title_canonical]) ?>"
                                       class="site-btn">Подробнее</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <?= Pager::widget([
                        'pagination' => $provider->pagination
                    ]) ?>
                <?php else: ?>
                    <p>Публикаций пока нет.</p>
                <?php endif; ?>
            </div>
            <div class="col-lg-4 sidebar">
                <?= Categories::widget() ?>

                <?= Videos::widget() ?>

                <?= Stream::widget() ?>
            </div>
        </div>
    </div>
</section>
