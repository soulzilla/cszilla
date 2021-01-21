<?php

/* @var $models app\models\Notification[] */

use app\components\helpers\StringHelper;

$this->title = 'Уведомления - CSZilla';
?>

<section class="blog-list-section pt-3">
    <div class="container notifications-container pb-1">
        <?php if (sizeof($models)): ?>
            <?php foreach ($models as $model): if (!$model->status) { $model->createStatus(); } ?>
                <a href="<?= $model->getUrl() ?>">
                    <div class="bordered-box mb-3 <?= $model->status ? '' : 'unread' ?>">
                        <div class="row mb-0">
                            <div class="col-auto"><?= $model->content ?></div>
                            <div class="ml-auto text-sm d-none d-lg-block"><?= StringHelper::humanize($model->ts) ?></div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="bordered-box">
                <p class="mb-0">
                    У вас пока нет уведомлений.
                </p>
            </div>
        <?php endif; ?>
    </div>
</section>
