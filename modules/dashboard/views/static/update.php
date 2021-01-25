<?php

use app\enums\StaticBlockEnum;
use mihaildev\ckeditor\CKEditor;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/* @var $model app\models\StaticBlock */

$this->title = StaticBlockEnum::label($model->type);

$form = ActiveForm::begin(); ?>

<?php if (in_array($model->type, [
    StaticBlockEnum::TYPE_MAIN_DESCRIPTION,
    StaticBlockEnum::TYPE_NEWS_DESCRIPTION,
    StaticBlockEnum::TYPE_TOP
])): ?>
    <?= $form->field($model, 'content')->widget(CKEditor::class, [
        'editorOptions' => [
            'preset' => 'full'
        ],
    ]) ?>
<?php endif; ?>

<?php if (in_array($model->type, [
    StaticBlockEnum::SOCIAL_VK,
    StaticBlockEnum::SOCIAL_TELEGRAM,
    StaticBlockEnum::SOCIAL_YOUTUBE,
    StaticBlockEnum::SOCIAL_TWITCH,
    StaticBlockEnum::SOCIAL_INSTAGRAM,
    StaticBlockEnum::SOCIAL_DISCORD,
])): ?>
    <?= $form->field($model, 'content')->textInput(['type' => 'url'])->label('Ссылка') ?>
<?php endif; ?>
<div class="form-group">
    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
