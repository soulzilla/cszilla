<?php

use app\components\helpers\StringHelper;
use app\components\helpers\Url;
use app\models\Contest;

/* @var $model Contest */
?>


<div class="sb-widget bordered-box">
    <h2 class="sb-title">Текущий розыгрыш</h2>
    <div class="latest-news-widget">
        <div class="ln-item">
            <div class="ln-text">
                <div class="ln-date"><?= StringHelper::humanize($model->date_start) ?></div>
                <?= $model->description ?>
                <div class="ln-metas">
                    <div class="ln-meta">
                        <a href="<?= Url::to(['/main/giveaways/view', 'id' => $model->id]) ?>">
                            Подробнее
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
