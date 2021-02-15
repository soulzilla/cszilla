<?php

use app\components\helpers\Url;
use app\enums\AttachmentsEnum;
use app\enums\CurrenciesEnum;
use app\enums\PaymentMethodsEnum;
use app\widgets\file\FileUpload;
use kartik\select2\Select2;
use mihaildev\ckeditor\CKEditor;
use unclead\multipleinput\MultipleInput;
use yii\helpers\Html;
use yii\web\JsExpression;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Bookmaker */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="bookmaker-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_canonical')->textInput(['maxlength' => true]) ?>

    <?= FileUpload::widget([
        'model' => $model,
        'attribute' => 'logo'
    ]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::class, [
        'editorOptions' => [
            'preset' => 'full'
        ]
    ]) ?>

    <?= $form->field($model, 'pros')->widget(MultipleInput::class, [
        'min' => 1,
        'allowEmptyList' => false,
        'enableGuessTitle' => true,
        'addButtonPosition' => MultipleInput::POS_FOOTER,
    ])->label(false) ?>

    <?= $form->field($model, 'cons')->widget(MultipleInput::class, [
        'min' => 1,
        'allowEmptyList' => false,
        'enableGuessTitle' => true,
        'addButtonPosition' => MultipleInput::POS_FOOTER,
    ])->label(false) ?>

    <?= $form->field($model, 'attachments')->widget(MultipleInput::class, [
        'addButtonPosition' => MultipleInput::POS_FOOTER,
        'max' => 6,
        'allowEmptyList' => true,
        'columns' => [
            [
                'name'  => 'type',
                'type'  => 'dropDownList',
                'title' => 'Тип',
                'defaultValue' => 1,
                'items' => AttachmentsEnum::labels()
            ],
            [
                'name'  => 'source',
                'title' => 'Ссылка',
            ]
        ]
    ])->label('Галерея') ?>

    <?= $form->field($model, 'related_publications')->widget(Select2::class, [
        'data' => [],
        'language' => 'ru',
        'initValueText' => $model->related_publications,
        'options' => [
            'placeholder' => 'Введите заголовок публикации ...',
            'multiple' => true,
            'value' => array_keys($model->related_publications)
        ],
        'pluginOptions' => [
            'allowClear' => true,
            'ajax' => [
                'url' => Url::to(['/dashboard/publications/search']),
                'dataType' => 'json',
                'data' => new JsExpression('function(params) { return {q:params.term}; }')
            ],
        ],
    ])->label('Связанные публикации'); ?>

    <?= $form->field($model, 'order')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'currencies')->checkboxList(CurrenciesEnum::labels()) ?>

    <?= $form->field($model, 'payment_methods')->checkboxList(PaymentMethodsEnum::labels()) ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => true, 'type' => 'url']) ?>

    <?= $form->field($model, 'android_app')->textInput(['maxlength' => true, 'type' => 'url']) ?>

    <?= $form->field($model, 'ios_app')->textInput(['maxlength' => true, 'type' => 'url']) ?>

    <?= $form->field($model, 'has_live_mode')->checkbox() ?>

    <?= $form->field($model, 'margin')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'has_license')->checkbox() ?>

    <?= $form->field($model, 'cupis')->checkbox() ?>

    <?= $form->field($model, 'recommended')->checkbox() ?>

    <?= $form->field($model, 'is_published')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
