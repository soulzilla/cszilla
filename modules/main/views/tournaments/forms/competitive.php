<?php

use app\components\helpers\Url;
use app\enums\FaqCategoriesEnum;
use app\forms\tournament\RegisterWingmanForm;
use yii\bootstrap4\ActiveForm;

/** @var $model RegisterWingmanForm */

$form = ActiveForm::begin([
    'enableAjaxValidation' => true,
    'validationUrl' => '/main/validate/competitive'
]);
?>

<?php $form::end(); ?>
<?php if (!$model->team): ?>
    <div class="nk-info-box text-danger">
        <div class="nk-info-box-icon">
            <i class="ion-close-round"></i>
        </div>
        <h3>Внимание!</h3>
        <em>У вас нет зарегистрированной команды. Перейдите по <a class="text-white" href="<?= Url::to(['/main/tournaments/register-team', 'format' => $model->getFormat()]) ?>">ссылке</a>, чтобы зарегистрировать команду.</em>
        <em>Подробнее о правилах регистрации можете прочитать <a class="text-white" href="<?= Url::to(['/main/faq/index', 'tab' => FaqCategoriesEnum::CATEGORY_TOURNAMENTS]) ?>">тут</a>.</em>
    </div>
<?php endif; ?>

<?php if (sizeof($model->teamSummary)): ?>
    <div class="nk-info-box text-danger">
        <div class="nk-info-box-icon">
            <i class="ion-close-round"></i>
        </div>
        <h3>Внимание!</h3>
        <?php foreach ($model->teamSummary as $summary): ?>
            <em><?= $summary ?></em>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
