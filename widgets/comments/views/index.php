<?php /* @var $models app\models\Comment[] */

use app\components\helpers\StringHelper; ?>

<div class="nk-widget nk-widget-highlighted">
    <h4 class="nk-widget-title"><span><span class="text-main-1">Новые</span> комментарии</span></h4>
    <div class="nk-widget-content">
        <?php if (sizeof($models)): ?>
            <?php foreach ($models as $model): ?>
                <a href="<?= $model->getUrl() ?>">
                    <div class="nk-comment">
                        <div class="nk-comment-meta"><?= $model->author->name ?></div>
                        <div class="nk-comment-text text-white"><?= nl2br($model->content) ?></div>
                        <div class="nk-post-date">
                            <span class="fa fa-calendar"></span>
                            <?= StringHelper::humanize($model->ts) ?>
                        </div>
                    </div>
                </a>
                <div class="nk-gap"></div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Комментариев пока нет.</p>
        <?php endif; ?>
    </div>
</div>
