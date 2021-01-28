<?php

/* @var $model Contest */
/* @var $winners ContestParticipant[] */

use app\components\helpers\StringHelper;
use app\components\helpers\Url;
use app\models\Contest;
use app\models\ContestParticipant;

$this->title = 'Итоги розыгрыша от ' . StringHelper::humanize($model->date_start, true, false) . ' - ' . StringHelper::humanize($model->date_end, true,false);
?>

<div class="container">
    <?php if (sizeof($winners)): ?>
        <h2>Победители розыгрыша</h2>
        <?php foreach ($winners as $winner): ?>
            <div class="w-100">
                <a target="_blank"
                   class="btn btn-primary"
                   rel="nofollow"
                   href="<?= $winner->user->steam_url ?? $winner->user->vk_url ?>">
                    <?= $winner->user->name ?>
                </a>
                <a class="btn btn-danger" href="<?= Url::to(['reset', 'id' => $winner->id]) ?>">
                    Сбросить
                </a>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
