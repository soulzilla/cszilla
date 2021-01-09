<?php
/* @var $models Comment[] */

/* @var $comment Comment */

use app\components\helpers\StringHelper;
use app\components\helpers\Url;
use app\models\Comment;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

?>

<section class="blog-list-section pb-3">
    <div class="container pl-lg-0">
        <div class="bordered-box">
            <div class="comments w-100 pb-0">
                <h5>Комментарии (<?= sizeof($models) ?>)</h5>
                <?php if (sizeof($models)): ?>
                    <ul class="comments-list">
                        <?php foreach ($models as $model): ?>
                            <li>
                                <div class="comment-text">
                                    <h6><?= $model->author->name ?></h6>
                                    <div class="comment-date"><?= StringHelper::humanize($model->ts) ?></div>
                                    <p><?= $model->content ?></p>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
                <?php if (!Yii::$app->user->isGuest): ?>
                    <div class="comment-form">
                        <?php $form = ActiveForm::begin([
                            'options' => [
                                'method' => 'post'
                            ],
                            'action' => Url::to(['/main/default/comment'])
                        ]) ?>

                        <?= $form->field($comment, 'content')->textarea(['placeholder' => 'Ваш комментарий'])->label(false) ?>

                        <?= $form->field($comment, 'entity_id')->hiddenInput()->label(false) ?>

                        <?= $form->field($comment, 'entity_table')->hiddenInput()->label(false) ?>

                        <div class="form-group">
                            <?= Html::submitButton('Отправить', ['class' => 'site-btn', 'name' => 'review-button']) ?>
                        </div>

                        <?php ActiveForm::end() ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
