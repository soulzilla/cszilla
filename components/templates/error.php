<?php

/* @var $this yii\web\View */
/* @var $publications app\models\Publication[] */
/* @var $code */
/* @var $message */

use app\components\helpers\StringHelper;
use app\components\helpers\Url;

?>
<section class="page-top-section">
    <div class="container">
        <h2><?= $code ?></h2>
    </div>
</section>

<section class="blog-list-section spad pb-3 pt-3 <?= sizeof($publications) ? '' : 'min-h-50' ?>">
    <div class="container">
        <div class="bordered-box text-break">
            <h2 class="text-white <?= sizeof($publications) ? 'mb-5' : '' ?>"><?= $message ?></h2>

            <?php if (sizeof($publications)): ?>
                <h4 class="text-white mb-3">Возможно, это будет интересно:</h4>
                <div class="row">
                    <?php foreach ($publications as $publication): ?>
                        <div class="col-md-6">
                            <div class="blog-post">
                                <h4><?= $publication->title ?></h4>
                                <div class="post-date" style="background-color: <?= $publication->category->color ?>">
                                    <?= StringHelper::humanize($publication->publish_date) ?>
                                </div>
                                <div class="post-metas">
                                    <div class="post-meta">
                                        <a href="<?= Url::to(['/main/news/index', 'category' => $publication->category_id]) ?>">
                                            <?= $publication->category->name ?>
                                        </a>
                                    </div>
                                    <div class="post-meta"><?= $publication->author->name ?></div>
                                </div>
                                <p><?= $publication->announce ?></p>
                                <a href="<?= Url::to(['/main/news/view', 'title_canonical' => $publication->title_canonical]) ?>"
                                   class="site-btn">Подробнее</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
