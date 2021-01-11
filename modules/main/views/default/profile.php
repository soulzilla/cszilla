<?php

/* @var $model User */
/* @var $isOwnProfile bool */

use app\models\User;
use app\widgets\settings\Settings;

$this->title = 'Профиль пользователя ' . $model->profile->name;
?>

<section class="blog-list-section py-3">
    <div class="container">
        <?= Settings::widget([
            'isOwnProfile' => $isOwnProfile,
            'model' => $model,
            'type' => 'bookmakers',
            'title' => 'Букмекеры'
        ]) ?>
    </div>
</section>

<section class="blog-list-section pb-y">
    <div class="container">
        <?= Settings::widget([
            'isOwnProfile' => $isOwnProfile,
            'model' => $model,
            'type' => 'casinos',
            'title' => 'Казино'
        ]) ?>
    </div>
</section>

<section class="blog-list-section spad pb-3">
    <div class="container">
        <?= Settings::widget([
            'isOwnProfile' => $isOwnProfile,
            'model' => $model,
            'type' => 'loot-boxes',
            'title' => 'Лутбоксы'
        ]) ?>
    </div>
</section>

<section class="blog-list-section spad pb-3">
    <div class="container">
        <?= Settings::widget([
            'isOwnProfile' => $isOwnProfile,
            'model' => $model,
            'type' => 'categories',
            'title' => 'Категории публикаций'
        ]) ?>
    </div>
</section>
