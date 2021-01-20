<?php

/* @var $model LootBox|Bookmaker|Casino */

use app\models\{LootBox, Bookmaker, Casino};

?>

<div class="row mb-3">
    <div class="col-6 col-lg-4" title="Средняя оценка наших пользователей">
        <p class="my-0">
            Оценка: <span class="average-rate"><?= $model->counter->average_rating ?></span>
        </p>
    </div>
    <div class="col-6 col-lg-4" title="Всего оценок наших пользователей">
        <p class="my-0">
            Оценок: <span class="total-rates"><?= $model->counter->ratings ?></span>
        </p>
    </div>
    <div class="col-6 col-lg-4" title="Игроков среди наших пользователей">
        <p class="my-0">
            Игроков: <?= $model->observers ? $model->observers->count : 0 ?>
        </p>
    </div>
    <div class="col-6 col-lg-4" title="Всего обзоров от наших пользователей">
        <p class="my-0">
            Обзоров: <span class="total-rates"><?= $model->counter->overviews ?></span>
        </p>
    </div>
    <div class="col-6 col-lg-4" title="Всего жалоб от наших пользователей">
        <p class="my-0">
            Жалоб: <span class="total-rates"><?= $model->counter->complaints ?></span>
        </p>
    </div>
</div>
