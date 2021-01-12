<?php

/* @var $models app\models\Notification[] */

$this->title = 'Уведомления - CS:GO Heaven';
?>

<section class="blog-list-section pt-3">
    <div class="container notifications-container">
        <?php if (sizeof($models)): ?>
            <?php foreach ($models as $model): if (!$model->status) { $model->createStatus(); } ?>
                <div class="bordered-box mb-3 <?= $model->status ? '' : 'unread' ?>">
                    <p class="mb-0"><?= $model->content ?></p>
                </div>
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
