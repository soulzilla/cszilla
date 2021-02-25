<?php

use app\components\helpers\Url;
use app\enums\FaqCategoriesEnum;
use app\forms\tournament\RegisterWingmanForm;
use app\widgets\clipboard\Clipboard;
use Eddmash\Clipboard\ClipboardAsset;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

/** @var $model RegisterWingmanForm */

ClipboardAsset::register($this);
?>

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
    <?php if ($model->inviteCode): ?>
        <?= Clipboard::input($this, 'text', 'url', $model->inviteCode, ['id' => 'url', 'readonly' => false]) ?>
    <?php endif; ?>
<?php endif; ?>

<?php if ($model->team && !$model->isCaptain()): ?>
    <div class="nk-info-box text-warning">
        <div class="nk-info-box-icon">
            <i class="ion-close-round"></i>
        </div>
        <h3>Внимание!</h3>
        <em>Вы уже состоите в команде "<?= $model->team->name ?>". Только капитан команды может регистрироваться на турнире.</em>
    </div>
<?php endif; ?>

<?php if ($model->hasAccess()): ?>
    <h4>Состав команды:</h4>
    <?php foreach ($model->getPlayers() as $player): ?>
    <p><?= $player->name ?></p>
    <?php endforeach; ?>
    <?php $form = ActiveForm::begin(['enableAjaxValidation' => true, 'validationUrl' => '/main/validate/wingman']); ?>

        <?= $form->field($model, 'team_id')->hiddenInput()->label(false) ?>

        <?= $form->field($model, 'tournament_id')->hiddenInput()->label(false) ?>

        <div class="form-group">
            <?= Html::submitButton('Подтвердить', ['class' => 'nk-btn nk-btn-rounded nk-btn-color-white nk-btn-block', 'name' => 'accept-button']) ?>
        </div>
    <?php $form::end() ?>
<?php endif; ?>
