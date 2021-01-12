<?php

/* @var $model User */
/* @var $isOwnProfile bool */

use app\models\User;
use app\widgets\settings\Settings;

$this->title = 'Профиль пользователя ' . $model->profile->name;
?>

<div class="row py-3 mw-100 ml-0">
    <section class="blog-list-section col-12 col-lg-6">
        <div class="container pr-3 pr-lg-0 h-100">
            <?= Settings::widget([
                'isOwnProfile' => $isOwnProfile,
                'model' => $model,
                'type' => 'bookmakers',
                'title' => 'Букмекеры'
            ]) ?>
        </div>
    </section>

    <section class="blog-list-section col-12 col-lg-6 pt-3 pt-lg-0">
        <div class="container pl-3 pl-lg-0 h-100">
            <?= Settings::widget([
                'isOwnProfile' => $isOwnProfile,
                'model' => $model,
                'type' => 'casinos',
                'title' => 'Казино'
            ]) ?>
        </div>
    </section>
</div>

<div class="row pb-3 mw-100 ml-0">
    <section class="blog-list-section col-12 col-lg-6">
        <div class="container pr-3 pr-lg-0 h-100">
            <?= Settings::widget([
                'isOwnProfile' => $isOwnProfile,
                'model' => $model,
                'type' => 'loot-boxes',
                'title' => 'Лутбоксы'
            ]) ?>
        </div>
    </section>

    <section class="blog-list-section col-12 col-lg-6 pt-3 pt-lg-0">
        <div class="container pl-3 pl-lg-0 h-100">
            <?= Settings::widget([
                'isOwnProfile' => $isOwnProfile,
                'model' => $model,
                'type' => 'categories',
                'title' => 'Категории публикаций'
            ]) ?>
        </div>
    </section>
</div>

<div class="row pb-3 mw-100 ml-0">
    <section class="blog-list-section col-12 col-lg-6">
        <div class="container pr-3 pr-lg-0 h-100">
            <div class="bordered-box h-100">
                <h2 class="text-white">Настройки</h2>
            </div>
        </div>
    </section>

    <section class="blog-list-section col-12 col-lg-6 pt-3 pt-lg-0">
        <div class="container pl-3 pl-lg-0 h-100">
            <div class="bordered-box h-100">
                <h2 class="text-white">Безопасность</h2>
            </div>
        </div>
    </section>
</div>
