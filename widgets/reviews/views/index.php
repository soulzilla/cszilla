<?php

use app\components\helpers\Url;
use app\models\Review;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\web\View;

/* @var $this View */
/* @var $model Review */
?>

<div class="nk-modal modal fade" id="review-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="ion-android-close"></span>
                </button>
                <div class="nk-gap-2"></div>
                <?php $form = ActiveForm::begin([
                    'options' => [
                        'method' => 'post',
                    ],
                    'enableAjaxValidation' => true,
                    'validationUrl' => '/main/validate/review',
                    'action' => Url::to(['/main/default/review'])
                ]); ?>

                <?= $form->field($model, 'content')->textarea(['placeholder' => 'Напишите свой отзыв', 'maxlength' => true, 'rows' => 5, 'style' => 'resize:none'])->label(false) ?>

                <div class="form-group">
                    <?= Html::submitButton('<span class="icon ion-paper-airplane"></span> Отправить', ['class' => 'nk-btn nk-btn-rounded nk-btn-color-white nk-btn-hover-color-main-1', 'name' => 'review-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
