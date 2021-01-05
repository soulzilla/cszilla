<?php

use app\components\helpers\Url;
use app\models\Complaint;
use yii\bootstrap4\{ActiveForm, Html, Modal};

/* @var $complaint Complaint */
?>

<?php Modal::begin([
    'id' => 'complaint-modal-' . $complaint->entity_id,
    'title' => 'Напишите жалобу'
]); ?>

<div class="comment-form">
    <?php $form = ActiveForm::begin([
        'options' => [
            'method' => 'post'
        ],
        'action' => Url::to(['/main/default/complaint'])
    ]) ?>

    <?= $form->field($complaint, 'body')->textarea(['placeholder' => 'Ваша жалоба'])->label(false) ?>

    <?= $form->field($complaint, 'entity_id')->hiddenInput()->label(false) ?>

    <?= $form->field($complaint, 'entity_table')->hiddenInput()->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'site-btn', 'name' => 'complaint-button']) ?>
    </div>

    <?php ActiveForm::end() ?>
</div>

<?php Modal::end(); ?>
