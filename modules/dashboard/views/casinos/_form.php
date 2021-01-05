<?php

use app\enums\CurrenciesEnum;
use app\enums\PaymentMethodsEnum;
use mihaildev\ckeditor\CKEditor;
use unclead\multipleinput\MultipleInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Casino */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="casino-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_canonical')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'logo')->textInput(['type' => 'url']) ?>

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

    <?= $form->field($model, 'order')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'currencies')->checkboxList(CurrenciesEnum::labels()) ?>

    <?= $form->field($model, 'payment_methods')->checkboxList(PaymentMethodsEnum::labels()) ?>

    <?= $form->field($model, 'website')->textInput(['maxlength' => true, 'type' => 'url']) ?>

    <?= $form->field($model, 'recommended')->checkbox() ?>

    <?= $form->field($model, 'is_published')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
