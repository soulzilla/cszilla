<?php

use app\components\helpers\StringHelper;
use app\models\Comment;
use app\widgets\like\Like;

/** @var $models Comment[] */
?>

<?php if (sizeof($models)): ?>
    <?php foreach ($models as $model): ?>
        <div class="nk-comment" id="comment-<?= $model->id ?>">
            <div class="nk-comment-meta">
                <span><?= $model->author->name ?></span>

                <?php if ($model->canDelete()): ?>
                    <a href="javascript:void(0)" data-id="<?= $model->id ?>"
                       class="delete-comment nk-btn nk-btn-rounded nk-btn-color-dark-3 float-right">
                        <span class="fa fa-times"></span>
                    </a>
                <?php endif; ?>
            </div>

            <div class="nk-comment-text">
                <p class="mb-0"><?= nl2br($model->content) ?></p>

                <div class="nk-comment-meta">
                    <span class="fa fa-calendar"></span>
                    <?= StringHelper::humanize($model->ts) ?>
                </div>

                <?php if (Yii::$app->user->isGuest): ?>
                    <a class="like-it pointer" href="#" data-toggle="modal" data-target="#auth-modal">
                        <i class="fa fa-heart-o"></i>
                        <span class="text-white" id="likes-count-<?= $model->id ?>"><?= $model->counter->likes ?></span>
                    </a>
                <?php else: ?>
                    <a href="javascript:void(0)"
                       class="like-it nk-btn nk-btn-rounded <?= $model->like ? 'nk-btn-color-main-1' : 'nk-btn-color-dark-3' ?>"
                       data-table="<?= $model->tableName() ?>"
                       data-id="<?= $model->getPrimaryKey() ?>">
                        <i class="fa fa-<?= $model->like ? 'heart' : 'heart-o' ?>" id="like-state-<?= $model->tableName() ?>-<?= $model->id ?>"></i>
                        <span class="text-white ml-1" id="likes-count-<?= $model->tableName() ?>-<?= $model->id ?>"><?= $model->counter->likes ?></span>
                    </a>
                <?php endif; ?>
                <a href="javascript:void(0)" data-id="<?= $model->id ?>" data-author="<?= $model->author->name ?>"
                   data-branch="<?= $model->parent_id ?? $model->id ?>"
                   class="reply-comment nk-btn nk-btn-rounded nk-btn-color-dark-3">
                    <span class="fa fa-reply"></span>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
