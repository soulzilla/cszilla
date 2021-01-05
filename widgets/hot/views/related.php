<?php

use app\components\helpers\StringHelper;
use app\components\helpers\Url;
use app\models\Publication;

/* @var $models Publication[] */
?>

<div class="sb-widget bordered-box">
    <h2 class="sb-title">Смотрите также</h2>
    <div class="latest-news-widget">
        <?php if (sizeof($models)): ?>
            <?php foreach ($models as $model): ?>
                <div class="ln-item">
                    <div class="ln-text">
                        <h6><?= $model->title ?></h6>
                        <div class="ln-date" style="background-color: <?= $model->category->color ?>"><?= StringHelper::humanize($model->publish_date) ?></div>
                        <div class="ln-metas">
                            <div class="ln-meta"><?= $model->author->name ?></div>
                            <div class="ln-meta">
                                <a href="<?= Url::to(['/main/news/view', 'title_canonical' => $model->title_canonical]) ?>">
                                    Подробнее
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>
                Ничего не найдено.
            </p>
        <?php endif; ?>
    </div>
</div>
