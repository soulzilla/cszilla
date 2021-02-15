<?php

use app\components\helpers\StringHelper;
use app\components\helpers\Url;
use app\models\{Bookmaker, Casino, LootBox};

/** @var $model Casino|Bookmaker|LootBox */
?>

<?php if ($model->publications): ?>
    <div class="nk-widget nk-widget-highlighted">
        <h4 class="nk-widget-title"><span><span class="text-main-1">Связанные</span> новости</span></h4>
        <div class="nk-widget-content">
            <?php foreach ($model->publications as $publication): ?>
                <div class="nk-widget-post pl-0">
                    <h3 class="nk-post-title">
                        <a href="<?= Url::to(['/main/news/view', 'title_canonical' => $publication->title_canonical]) ?>">
                            <?= $publication->title ?>
                        </a>
                    </h3>
                    <div class="nk-post-date"><span class="fa fa-calendar"></span> <?= StringHelper::humanize($publication->publish_date) ?></div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
