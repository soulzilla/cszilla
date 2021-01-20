<?php

use app\components\helpers\Url;
use app\models\Overview;
use yii\bootstrap4\{ActiveForm, Html, Modal};

/* @var $overview Overview */
?>

<?php Modal::begin([
    'id' => 'overview-modal-' . $overview->entity_id,
    'title' => 'Напишите обзор'
]); ?>

    <div class="comment-form">
        <?php $form = ActiveForm::begin([
            'options' => [
                'method' => 'post'
            ],
            'action' => Url::to(['/main/default/overview'])
        ]) ?>

        <?= $form->field($overview, 'body')->textarea(['placeholder' => 'Ваш обзор'])->label(false) ?>

        <?= $form->field($overview, 'entity_id')->hiddenInput()->label(false) ?>

        <?= $form->field($overview, 'entity_table')->hiddenInput()->label(false) ?>

        <div class="form-group">
            <?= Html::submitButton('Отправить', ['class' => 'site-btn', 'name' => 'review-button']) ?>
        </div>

        <?php ActiveForm::end() ?>
    </div>

<?php Modal::end(); ?>
