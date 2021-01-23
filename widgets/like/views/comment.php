<?php

use app\models\Comment;

/* @var $model Comment */

?>

<div class="ml-auto">
    <?php if (Yii::$app->user->isGuest): ?>
        <a class="like-it pointer" href="#" data-toggle="modal" data-target="#auth-modal">
            <i class="fa fa-heart-o"></i>
            <span class="text-white" id="likes-count-<?= $model->id ?>"><?= $model->counter->likes ?></span>
        </a>
    <?php else: ?>
        <a class="like-it pointer"
           href="javascript:void(0)"
           data-table="<?= $model->tableName() ?>"
           data-id="<?= $model->getPrimaryKey() ?>">
            <i class="fa fa-<?= $model->like ? 'heart' : 'heart-o' ?>" id="like-state-<?= $model->tableName() ?>-<?= $model->id ?>"></i>
            <span class="text-white ml-1" id="likes-count-<?= $model->tableName() ?>-m<?= $model->id ?>"><?= $model->counter->likes ?></span>
        </a>
    <?php endif; ?>
</div>
