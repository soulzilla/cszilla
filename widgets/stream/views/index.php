<?php

/* @var app\models\Stream $model */

use app\components\helpers\Url;
use app\enums\StreamSourcesEnum;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;

?>

<div class="sb-widget bordered-box">
    <h2 class="sb-title">
        Стрим
        <?php if (Yii::$app->usersService->isGranted(['ROLE_SUPER_ADMIN'])): ?>
            <a class="text-white" href="#" data-toggle="modal" data-target="#stream-modal">
                <i class="fa fa-plus"></i>
            </a>
        <?php endif; ?>
    </h2>
    <?php if ($model->id): ?>
        <iframe class="mw-100"
                src="<?= $model->getEmbedUrl() ?>"
                height="auto"
                frameborder="false"
                width="auto">
        </iframe>
        <p>
            <?= $model->description ?>

            <?php if (Yii::$app->usersService->isGranted(['ROLE_SUPER_ADMIN'])): ?>
                <a class="text-white" href="#" data-toggle="modal" data-target="#stream-modal">
                    <i class="fa fa-pencil"></i>
                </a>
            <?php endif; ?>
        </p>
        <a class="site-btn" target="_blank" href="<?= $model->url ?>">
            <i class="fa fa-<?= StreamSourcesEnum::label($model->source) ?>"></i>
            Смотреть
        </a>
    <?php else: ?>
        <p>
            Активных стримов пока нет.
        </p>
    <?php endif; ?>
    <?php if (Yii::$app->usersService->isGranted(['ROLE_SUPER_ADMIN'])): ?>

        <?php Modal::begin([
            'id' => 'stream-modal'
        ]);
        ?>
        <div class="comment-form mt-3">
            <?php $form = ActiveForm::begin([
                'options' => [
                    'method' => 'post'
                ],
                'enableAjaxValidation' => true,
                'action' => Url::to(['/main/default/stream'])
            ]); ?>

            <?php if ($model->id): ?>
                <?= $form->field($model, 'id')->hiddenInput()->label(false) ?>
            <?php endif; ?>

            <?= $form->field($model, 'source')->dropDownList(StreamSourcesEnum::labels())->label(false) ?>

            <?= $form->field($model, 'description')->textInput(['placeholder' => 'Описание'])->label(false) ?>

            <?= $form->field($model, 'url')->textInput(['placeholder' => 'Ссылка', 'type' => 'url'])->label(false) ?>

            <?= $form->field($model, 'is_finished')->checkbox() ?>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'site-btn', 'name' => 'review-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>

        <?php Modal::end(); ?>
    <?php endif; ?>
</div>
