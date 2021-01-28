<?php
/* @var $models Comment[] */
/* @var $provider ActiveDataProvider */

/* @var $comment Comment */

use app\components\helpers\StringHelper;
use app\components\helpers\Url;
use app\models\Comment;
use app\widgets\like\Like;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\data\ActiveDataProvider;

$models = $provider->getModels();
?>
<div id="comments"></div>
<h3 class="nk-decorated-h-2">
    <span class="text-main-1">Комментарии
        <span class="comments-count text-white"><?= $provider->getTotalCount() ?></span>
    </span>
</h3>
<div class="nk-gap"></div>
<div class="nk-comments">
    <div class="comments-list">
        <?php if (sizeof($models)): ?>
            <?php foreach ($models as $model): ?>
                <div class="nk-comment" id="comment-<?= $model->id ?>">
                    <div class="nk-comment-meta">
                        <span><?= $model->author->name ?></span>

                        <?php if ($model->canDelete()): ?>
                            <a href="javascript:void(0)" rel="nofollow" data-id="<?= $model->id ?>"
                               class="delete-comment nk-btn nk-btn-rounded nk-btn-color-dark-3 float-right">
                                <span class="fa fa-times"></span>
                            </a>
                        <?php endif; ?>
                    </div>

                    <div class="nk-comment-text">
                        <p class="mb-0"><?= nl2br($model->content) ?></p>

                        <div class="nk-gap"></div>

                        <div class="nk-comment-meta">
                            <span class="fa fa-calendar"></span>
                            <?= StringHelper::humanize($model->ts) ?>
                        </div>
                        <?php if (Yii::$app->user->isGuest): ?>
                            <a class="like-it nk-btn nk-btn-rounded nk-btn-color-dark-3" href="#" data-toggle="modal" data-target="#auth-modal">
                                <i class="fa fa-heart-o"></i>
                                <span class="text-white" id="likes-count-<?= $model->id ?>"><?= $model->counter->likes ?></span>
                            </a>
                        <?php else: ?>
                            <a href="javascript:void(0)" rel="nofollow"
                               class="like-it nk-btn nk-btn-rounded <?= $model->like ? 'nk-btn-color-main-1' : 'nk-btn-color-dark-3' ?>"
                               data-table="<?= $model->tableName() ?>"
                               data-id="<?= $model->getPrimaryKey() ?>">
                                <i class="fa fa-<?= $model->like ? 'heart' : 'heart-o' ?>" id="like-state-<?= $model->tableName() ?>-<?= $model->id ?>"></i>
                                <span class="text-white ml-1" id="likes-count-<?= $model->tableName() ?>-<?= $model->id ?>"><?= $model->counter->likes ?></span>
                            </a>
                        <?php endif; ?>
                        <?php /* <a href="javascript:void(0)" data-id="<?= $model->id ?>" data-author="<?= $model->author->name ?>"
                           data-branch="<?= $model->parent_id ?? $model->id ?>"
                           class="reply-comment nk-btn nk-btn-rounded nk-btn-color-dark-3">
                            <span class="fa fa-reply"></span>
                        </a>*/ ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php if ($provider->getPagination()->getPageCount() > 1): ?>
        <div class="nk-gap"></div>
        <a class="more-comments nk-btn nk-btn-rounded nk-btn-color-dark-3" data-id="<?= $comment->entity_id ?>"
           data-max-pages="<?= $provider->getPagination()->getPageCount() ?>"
           data-next-page="2"
           data-table="<?= $comment->entity_table ?>" href="javascript:void(0)" rel="nofollow">Показать ещё</a>
    <?php endif; ?>

    <?php if (!Yii::$app->user->isGuest): ?>
        <div class="nk-gap-2"></div>
        <div class="nk-reply">
            <?php $form = ActiveForm::begin([
                'options' => [
                    'method' => 'post',
                    'id' => 'comment-body-form',
                    'class' => 'nk-form'
                ],
                'action' => Url::to(['/main/default/comment'])
            ]) ?>

            <?= $form->field($comment, 'content')->textarea(['placeholder' => 'Ваш комментарий', 'rows' => 5, 'style' => 'resize:none'])->label(false) ?>

            <?= $form->field($comment, 'entity_id')->hiddenInput()->label(false) ?>

            <?= $form->field($comment, 'entity_table')->hiddenInput()->label(false) ?>

            <div class="form-group">
                <a class="send-comment nk-btn nk-btn-rounded nk-btn-color-main-1"
                   data-table="<?= $comment->entity_table ?>"
                   data-id="<?= $comment->entity_id ?>" href="javascript:void(0)" rel="nofollow">
                    <span class="icon ion-paper-airplane"></span>
                    Отправить
                </a>
            </div>

            <?php ActiveForm::end() ?>
        </div>
    <?php endif; ?>
</div>
