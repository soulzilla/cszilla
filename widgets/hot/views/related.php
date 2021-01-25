<?php

use app\components\helpers\StringHelper;
use app\components\helpers\Url;
use app\models\Publication;

/* @var $models Publication[] */
?>

<?php if (sizeof($models)): ?>
    <div class="nk-widget nk-widget-highlighted">
        <h4 class="nk-widget-title"><span><span class="text-main-1">Смотрите</span> также</span></h4>
        <div class="nk-widget-content">
            <?php foreach ($models as $model): ?>
                <div class="nk-widget-post pl-0">
                    <h3 class="nk-post-title">
                        <a href="<?= Url::to(['/main/news/view', 'title_canonical' => $model->title_canonical]) ?>">
                            <?= $model->title ?>
                        </a>
                    </h3>
                    <div class="nk-post-date"><span class="fa fa-calendar"></span> <?= StringHelper::humanize($model->publish_date) ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
