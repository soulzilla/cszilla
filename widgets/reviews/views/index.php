<?php

use app\components\helpers\Url;
use app\models\Review;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\bootstrap4\Modal;
use yii\web\View;

/* @var $this View */
/* @var $model Review */

Modal::begin([
    'id' => 'review-modal',
    'title' => 'Оставить отзыв'
]);
?>

<div class="comment-form mt-3">
    <?php $form = ActiveForm::begin([
        'options' => [
            'method' => 'post',
        ],
        'enableAjaxValidation' => true,
        'validationUrl' => '/main/validate/review',
        'action' => Url::to(['/main/default/review'])
    ]); ?>

    <?= $form->field($model, 'content')->textarea(['placeholder' => 'Напишите свой отзыв', 'maxlength' => true])->label(false) ?>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'site-btn', 'name' => 'review-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<?php Modal::end(); ?>
