<?php

/* @var $model LootBox|Bookmaker|Casino */

use app\models\{LootBox, Bookmaker, Casino};

?>

<div class="nk-teammate-card bg-transparent">
    <div class="nk-teammate-card-photo">
        <img src="<?= $model->logo ?>" alt="<?= $model->name_canonical ?>">
    </div>

    <div class="nk-teammate-card-info">
        <table>
            <tbody>
            <tr>
                <td class="w-25 pl-30">
                    <strong class="h3"><?= $model->observers->count ?></strong>
                </td>
                <td class="w-75">
                    <strong class="h5">Игроков на нашем сайте</strong>
                </td>
            </tr>
            <tr>
                <td class="w-25 pl-30">
                    <strong class="average-rate-<?= $model->tableName() ?>-<?= $model->id ?> h3"><?= $model->counter->average_rating ?></strong>
                </td>
                <td class="w-75">
                    <strong class="h5">Средняя оценка пользователей</strong>
                </td>
            </tr>
            <tr>
                <td class="w-25 pl-30">
                    <strong class="total-rates-<?= $model->tableName() ?>-<?= $model->id ?> h3"><?= $model->counter->ratings ?></strong>
                </td>
                <td class="w-75">
                    <strong class="h5">Всего оценок пользователей</strong>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
