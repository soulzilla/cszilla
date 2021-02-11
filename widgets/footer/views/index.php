<?php /* @var $links app\models\StaticBlock[] */
/* @var $pages app\models\Page[] */
/* @var $model app\models\Message */

use app\components\helpers\Url;
use yii\bootstrap4\ActiveForm; ?>

<footer class="nk-footer">
    <div class="container">
        <div class="nk-gap-3"></div>
        <div class="nk-widget">
            <h4 class="nk-widget-title"><span class="text-main-1">Обратная</span> связь</h4>
            <div class="nk-widget-content">
                <?php $form = ActiveForm::begin([
                    'id' => 'contact-form',
                    'action' => Url::to(['/main/default/contact']),
                    'enableAjaxValidation' => true,
                    'validationUrl' => Url::to(['/main/validate/contact'])
                ]) ?>

                <div class="row vertical-gap sm-gap">
                    <div class="col-md-6">
                        <?= $form->field($model, 'email')->textInput(['placeholder' => 'E-mail'])->label(false) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'additional_info')->textInput(['placeholder' => 'Контактные данные'])->label(false) ?>
                    </div>
                </div>
                <div class="nk-gap"></div>
                <?= $form->field($model, 'content')->textarea(['rows' => 5, 'class' => 'form-control resize-none', 'placeholder' => 'Ваше сообщение'])->label(false) ?>
                <div class="nk-gap"></div>
                <?php if (Yii::$app->user->isGuest): ?>
                    <a href="#" rel="nofollow" data-toggle="modal" data-target="#auth-modal" class="nk-btn nk-btn-rounded nk-btn-color-white">
                        <span>Отправить</span>
                        <span class="icon"><i class="ion-paper-airplane"></i></span>
                    </a>
                <?php else: ?>
                    <button type="submit" class="nk-btn nk-btn-rounded nk-btn-color-white">
                        <span>Отправить</span>
                        <span class="icon"><i class="ion-paper-airplane"></i></span>
                    </button>
                <?php endif; ?>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
        <div class="nk-gap-2"></div>
    </div>
    <div class="nk-copyright">
        <div class="container">
            <div class="nk-copyright-left">
                <?php if (sizeof($pages)): $last = array_key_last($pages); ?>
                    <?php foreach ($pages as $key => $page): ?>
                        <a href="<?= Url::to(['/main/default/page', 'title_canonical' => $page->title_canonical]) ?>" class="<?= $key == $last ? '' : 'mr-10' ?>">
                            <?= $page->title ?>
                        </a>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="nk-copyright-right">
                <div class="nk-gap d-block d-lg-none"></div>
                <ul class="nk-social-links-2">
                    <?php foreach ($links as $link): ?>
                        <li>
                            <a target="_blank" class="nk-social-<?= $link->getIcon() ?>" href="<?= $link->content ?>">
                                <span class="fa fa-<?= $link->getIcon() ?>"></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</footer>
