<?php

/* @var $models app\models\Video[] */
/* @var $video app\models\Video */

use app\components\helpers\Url;
use app\enums\StreamSourcesEnum;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;
?>

<div class="sb-widget bordered-box">
    <h2 class="sb-title">
        Видео-материалы
        <?php if (Yii::$app->usersService->isGranted(['ROLE_SUPER_ADMIN'])): ?>
            <a class="text-white" href="#" data-toggle="modal" data-target="#video-modal">
                <i class="fa fa-plus"></i>
            </a>
        <?php endif; ?>
    </h2>
    <?php if (sizeof($models)): ?>
        <?php foreach ($models as $model): ?>
            <iframe class="mw-100"
                    src="<?= $model->getEmbedUrl() ?>"
                    height="auto"
                    frameborder="false"
                    width="auto">
            </iframe>
            <p>
                <?= $model->description ?>
                <?php if (Yii::$app->usersService->isGranted(['ROLE_SUPER_ADMIN'])): ?>
                    <a class="text-white" href="#" data-toggle="modal" data-target="#video-modal-<?= $model->id ?>">
                        <i class="fa fa-pencil"></i>
                    </a>
                <?php endif; ?>
            </p>
            <?php if (Yii::$app->usersService->isGranted(['ROLE_SUPER_ADMIN'])): ?>

                <?php Modal::begin([
                    'id' => 'video-modal-'.$model->id
                ]);
                ?>
                <div class="comment-form mt-3">
                    <?php $form = ActiveForm::begin([
                        'options' => [
                            'method' => 'post'
                        ],
                        'action' => Url::to(['/main/default/video'])
                    ]); ?>

                    <?= $form->field($model, 'id')->hiddenInput(['value' => $model->id])->label(false) ?>

                    <?= $form->field($model, 'source')->dropDownList(StreamSourcesEnum::labels())->label(false) ?>

                    <?= $form->field($model, 'description')->textInput(['placeholder' => 'Описание'])->label(false) ?>

                    <?= $form->field($model, 'url')->textInput(['placeholder' => 'Ссылка', 'type' => 'url'])->label(false) ?>

                    <?= $form->field($model, 'is_published')->checkbox() ?>

                    <div class="form-group">
                        <?= Html::submitButton('Сохранить', ['class' => 'site-btn', 'name' => 'review-button']) ?>

                        <?php if ($model->id): ?>
                            <?= Html::a('Удалить', ['/main/videos/delete', 'id' => $model->id], ['class' => 'site-btn']) ?>
                        <?php endif; ?>
                    </div>

                    <?php ActiveForm::end(); ?>
                </div>

                <?php Modal::end(); ?>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php else: ?>
        <p>
            Видео пока нет.
        </p>
    <?php endif; ?>
    <?php if (Yii::$app->usersService->isGranted(['ROLE_SUPER_ADMIN'])): ?>

        <?php Modal::begin([
            'id' => 'video-modal'
        ]); ?>
        <div class="comment-form mt-3">
            <?php $form = ActiveForm::begin([
                'options' => [
                    'method' => 'post'
                ],
                'action' => Url::to(['/main/default/video'])
            ]); ?>

            <?= $form->field($model, 'source')->dropDownList(StreamSourcesEnum::labels())->label(false) ?>

            <?= $form->field($video, 'description')->textInput(['placeholder' => 'Описание'])->label(false) ?>

            <?= $form->field($video, 'url')->textInput(['placeholder' => 'Ссылка', 'type' => 'url'])->label(false) ?>

            <?= $form->field($video, 'is_published')->checkbox() ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'site-btn', 'name' => 'review-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

        <?php Modal::end(); ?>
    <?php endif; ?>
</div>
