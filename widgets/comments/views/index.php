<?php /* @var $models app\models\Comment[] */

use app\components\helpers\StringHelper; ?>

<div class="sb-widget bordered-box mt-sm-3 mt-lg-0">
    <h2 class="sb-title">Последние комментарии</h2>
    <div class="latest-comments-widget">
        <?php if (sizeof($models)): ?>
            <?php foreach ($models as $model): ?>
                <a href="<?= $model->getUrl() ?>">
                    <div class="lc-item">
                        <div class="lc-text">
                            <div class="h6 text-white"><?= $model->author->name ?></div>
                            <div class="lc-date"><?= StringHelper::humanize($model->ts) ?></div>
                            <p><?= nl2br($model->content) ?></p>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>Комментариев пока нет.</p>
        <?php endif; ?>
    </div>
</div>
