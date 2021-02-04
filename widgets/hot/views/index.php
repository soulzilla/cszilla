<?php

/* @var $models app\models\Publication[] */

use app\components\helpers\StringHelper;
use app\components\helpers\Url;

?>

<div class="sb-widget bordered-box">
    <h2 class="sb-title">Последние публикации</h2>
    <div class="latest-news-widget">
        <?php foreach ($models as $model): ?>
            <div class="ln-item">
                <div class="ln-text">
                    <div class="date-text" title="<?= StringHelper::humanize($model->ts, true) ?>"
                         style="background-color: <?= $model->category->color ?>">
                        <?= StringHelper::humanize($model->publish_date) ?>
                    </div>
                    <a href="<?= Url::to(['/main/news/view', 'title_canonical' => $model->title_canonical]) ?>">
                        <h6><?= $model->title ?></h6>
                    </a>
                    <div class="ln-metas">
                        <div class="ln-meta"><?= $model->author->name ?></div>
                        <div class="ln-meta">
                            <a href="<?= Url::to(['/main/categories/view', 'name_canonical' => $model->category->name_canonical]) ?>">
                                <?= $model->category->name ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
