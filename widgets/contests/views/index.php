<?php

use app\components\helpers\StringHelper;
use app\components\helpers\Url;
use app\models\Contest;

/* @var $model Contest */
?>

<?php if ($model): ?>
    <div class="sb-widget bordered-box">

        <h2 class="sb-title">
            <a class="text-white" href="<?= Url::to(['/main/giveaways/view', 'id' => $model->id]) ?>">
                Текущий розыгрыш
            </a>
        </h2>
        <div class="latest-news-widget">
            <div class="ln-item">
                <div class="ln-text">
                    <a href="<?= Url::to(['/main/giveaways/view', 'id' => $model->id]) ?>">
                        <div class="date-text" title="<?= StringHelper::humanize($model->ts, true) ?>">
                            <?= StringHelper::humanize($model->date_start) ?>
                        </div>
                        <?= $model->description ?>
                    </a>
                </div>
            </div>
        </div>

    </div>
<?php endif; ?>

