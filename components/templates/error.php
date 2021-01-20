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

<section class="blog-list-section pb-3 pt-3">
    <div class="container">
        <div class="bordered-box text-break">
            <h2 class="text-white <?= sizeof($publications) ? 'mb-5' : '' ?>"><?= $message ?></h2>

            <?php if (sizeof($publications)): ?>
                <h3 class="text-white mb-3">Возможно, это будет интересно:</h3>
                <div class="row">
                    <?php foreach ($publications as $publication): ?>
                        <div class="col-md-6">
                            <div class="blog-post">
                                <h4>
                                    <a class="text-white" href="<?= Url::to(['/main/news/view', 'title_canonical' => $publication->title_canonical]) ?>">
                                        <?= $publication->title ?>
                                    </a>
                                </h4>
                                <div class="date-text">
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
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
