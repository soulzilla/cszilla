<?php

/* @var $provider ActiveDataProvider */
/* @var $models Publication[] */
/* @var $category app\models\Category|null */

use app\components\helpers\{StringHelper, Url};
use app\enums\StaticBlockEnum;
use app\models\Publication;
use app\widgets\{categories\Categories, pager\Pager, reviews\Reviews, stream\Stream, videos\Videos};
use yii\data\ActiveDataProvider;

$this->title = 'Новости - CSZilla';

$models = $provider->getModels();

echo Reviews::widget();
?>

<section class="blog-list-section py-3">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 bordered-box text-break mx-3 mx-lg-0 mb-3 mb-lg-0">
                <div class="blog-post featured-post">
                    <h2 class="text-white mb-3"><?= $category ? $category->name : 'Новости' ?></h2>
                    <?= Yii::$app->staticBlocksService->getNewsDescription()->content; ?>
                    <?php if (Yii::$app->usersService->isGranted(['ROLE_SUPER_ADMIN'])): ?>
                        <a href="<?= Url::to(['/dashboard/static/update', 'type' => StaticBlockEnum::TYPE_NEWS_DESCRIPTION]) ?>" class="text-white">
                            <i class="fa fa-pencil"></i>
                        </a>
                    <?php endif; ?>
                </div>
                <?php if (sizeof($models)): ?>
                    <div class="row">
                        <?php foreach ($models as $model): ?>
                            <div class="col-md-6">
                                <div class="blog-post">
                                    <h4>
                                        <a class="text-white" href="<?= Url::to(['/main/news/view', 'title_canonical' => $model->title_canonical]) ?>">
                                            <?= $model->title ?>
                                        </a>
                                    </h4>
                                    <div class="date-text">
                                        <?= StringHelper::humanize($model->publish_date) ?>
                                    </div>
                                    <div class="post-metas">
                                        <div class="post-meta"><?= $model->category->name ?></div>
                                        <div class="post-meta"><?= $model->author->name ?></div>
                                    </div>
                                    <p><?= $model->announce ?></p>
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
