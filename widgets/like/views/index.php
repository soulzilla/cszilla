<?php

use app\components\core\ActiveRecord;

/* @var $model ActiveRecord */

?>

<div class="w-100"
     style="position: absolute; bottom: 0; left: 0">
    <div class="like-container pl-30">
        <div class="nk-gap"></div>
        <?php if (Yii::$app->user->isGuest): ?>
            <a class="like-it nk-btn nk-btn-rounded nk-btn-color-dark-3" href="#" data-toggle="modal" data-target="#auth-modal">
                <i class="fa fa-heart-o"></i>
                <span class="text-white ml-1" id="likes-count-<?= $model->tableName() ?>-<?= $model->id ?>"><?= $model->counter->likes ?></span>
            </a>
        <?php else: ?>
            <a class="like-it nk-btn nk-btn-rounded <?= $model->like ? 'nk-btn-color-main-1' : 'nk-btn-color-dark-3' ?>"
               href="javascript:void(0)"
               data-table="<?= $model->tableName() ?>"
               data-id="<?= $model->getPrimaryKey() ?>">
                <i class="fa fa-<?= $model->like ? 'heart' : 'heart-o' ?>" id="like-state-<?= $model->tableName() ?>-<?= $model->id ?>"></i>
                <span class="text-white ml-1" id="likes-count-<?= $model->tableName() ?>-<?= $model->id ?>"><?= $model->counter->likes ?></span>
            </a>
        <?php endif; ?>
        <div class="nk-gap"></div>
    </div>
</div>
