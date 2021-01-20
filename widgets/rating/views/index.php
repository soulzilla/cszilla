<?php

/** @var Casino|Bookmaker|LootBox $model */

use app\models\{Bookmaker, Casino, LootBox};
?>
<div class="rating">
    <?php if ($model->rating) : ?>
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <a href="javascript:void(0)"
               class="rate-it"
               data-rate="<?= $i ?>"
               data-id="<?= $model->id ?>" data-table="<?= $model->tableName() ?>">
                <i class="fa fa-star<?= ($i <= $model->rating->rate) ? '' : '-o' ?>"></i>
            </a>
        <?php endfor; ?>
    <?php else: ?>
        <a href="javascript:void(0)"
           class="rate-it"
           data-rate="1"
           data-id="<?= $model->id ?>" data-table="<?= $model->tableName() ?>">
            <i class="fa fa-star-o"></i>
        </a>
        <a href="javascript:void(0)"
           class="rate-it"
           data-rate="2"
           data-id="<?= $model->id ?>" data-table="<?= $model->tableName() ?>">
            <i class="fa fa-star-o"></i>
        </a>
        <a href="javascript:void(0)"
           class="rate-it"
           data-rate="3"
           data-id="<?= $model->id ?>" data-table="<?= $model->tableName() ?>">
            <i class="fa fa-star-o"></i>
        </a>
        <a href="javascript:void(0)"
           class="rate-it"
           data-rate="4"
           data-id="<?= $model->id ?>" data-table="<?= $model->tableName() ?>">
            <i class="fa fa-star-o"></i>
        </a>
        <a href="javascript:void(0)"
           class="rate-it"
           data-rate="5"
           data-id="<?= $model->id ?>" data-table="<?= $model->tableName() ?>">
            <i class="fa fa-star-o"></i>
        </a>
    <?php endif; ?>
</div>
<p class="my-0">
    Средняя оценка: <span class="average-rate"><?= $model->counter->average_rating ?></span>
</p>
<p class="my-0">
    Всего оценок: <span class="total-rates"><?= $model->counter->ratings ?></span>
</p>
