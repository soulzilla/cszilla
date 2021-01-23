<?php

use app\components\helpers\StringHelper;
use app\components\helpers\Url;
use app\models\Publication;

/* @var $models Publication[] */
?>

<?php if (sizeof($models)): ?>
    <div class="sb-widget bordered-box">
        <h2 class="sb-title">Смотрите также</h2>
        <div class="latest-news-widget">
            <?php foreach ($models as $model): ?>
                <div class="ln-item">
                    <div class="ln-text">
                        <h6>
                            <a class="text-white"
                               href="<?= Url::to(['/main/news/view', 'title_canonical' => $model->title_canonical]) ?>">
                                <?= $model->title ?>
                            </a>
                        </h6>
                        <div class="date-text">
                            <?= StringHelper::humanize($model->publish_date) ?>
                        </div>
                        <div class="ln-metas">
                            <div class="ln-meta"><?= $model->author->name ?></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
