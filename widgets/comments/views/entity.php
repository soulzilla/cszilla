<?php
/* @var $models Comment[] */
/* @var $provider ActiveDataProvider */

/* @var $comment Comment */

use app\components\helpers\StringHelper;
use app\components\helpers\Url;
use app\models\Comment;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\data\ActiveDataProvider;

$models = $provider->getModels();
?>

<section class="blog-list-section pb-3">
    <div class="container pl-lg-0">
        <div class="bordered-box">
            <div class="comments w-100 pb-0">
                <h5>Комментарии (<span class="comments-count"><?= $provider->getTotalCount() ?></span>)</h5>
                <ul class="comments-list">
                    <?php if (sizeof($models)): ?>
                        <?php foreach ($models as $model): ?>
                            <li id="comment-<?= $model->id ?>">
                                <div class="row">
                                    <div class="comment-text col-auto pr-0">
                                        <h6><?= $model->author->name ?></h6>
                                        <div class="comment-date"><?= StringHelper::humanize($model->ts) ?></div>
                                        <p class="text-break"><?= $model->content ?></p>
                                    </div>
                                    <?php if ($model->canDelete()): ?>
                                        <div class="ml-auto mr-3">
                                            <a href="javascript:void(0)" class="delete-comment"
                                               data-id="<?= $model->id ?>">
                                                <i class="fa fa-times text-danger"></i>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </li>
                        <?php endforeach; ?>
                        <?php if ($provider->getPagination()->getPageCount() > 1): ?>
                            <a class="more-comments" data-id="<?= $comment->entity_id ?>"
                               data-max-pages="<?= $provider->getPagination()->getPageCount() ?>"
                               data-next-page="2"
                               data-table="<?= $comment->entity_table ?>" href="javascript:void(0)">Показать ещё</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </ul>
                <?php if (!Yii::$app->user->isGuest): ?>
                    <div class="comment-form">
                        <?php $form = ActiveForm::begin([
                            'options' => [
                                'method' => 'post',
                                'id' => 'comment-body-form'
                            ],
                            'action' => Url::to(['/main/default/comment'])
                        ]) ?>

                        <?= $form->field($comment, 'content')->textarea(['placeholder' => 'Ваш комментарий'])->label(false) ?>

                        <?= $form->field($comment, 'entity_id')->hiddenInput()->label(false) ?>

                        <?= $form->field($comment, 'entity_table')->hiddenInput()->label(false) ?>

                        <div class="form-group">
                            <a class="send-comment site-btn"
                               data-table="<?= $comment->entity_table ?>"
                               data-id="<?= $comment->entity_id ?>" href="javascript:void(0)">Отправить</a>
                        </div>

                        <?php ActiveForm::end() ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
