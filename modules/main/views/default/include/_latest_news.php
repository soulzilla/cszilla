<?php /* @var $models app\models\Publication[] */

use app\components\helpers\StringHelper;
use app\components\helpers\Url;
$firstKey = array_key_first($models);
?>

<div class="nk-gap-2"></div>

<h3 class="nk-decorated-h-2">
    <span>
        <span class="text-main-1">Последние</span> Новости
    </span>
</h3>

<div class="nk-gap"></div>

<div class="nk-news-box">
    <div class="nk-news-box-list">
        <div class="nano">
            <div class="nano-content">
                <?php foreach ($models as $key => $model): ?>
                    <div class="nk-news-box-item nk-news-box-item<?= $key == $firstKey ? '-active' : '' ?>">
                        <h3 class="nk-news-box-item-title"><?= $model->title ?></h3>

                        <span class="nk-news-box-item-categories">
                            <span class="<?= $model->category->color ?>"><?= $model->category->name ?></span>
                        </span>

                        <div class="nk-news-box-item-text">
                            <p><?= $model->announce ?></p>
                        </div>

                        <a href="<?= Url::to(['/main/news/view', 'title_canonical' => $model->title_canonical]) ?>" class="nk-news-box-item-url">
                            Подробнее
                        </a>

                        <div class="nk-news-box-item-date">
                            <span class="fa fa-calendar"></span>
                            <?= StringHelper::humanize($model->publish_date) ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <div class="nk-news-box-each-info">
        <div class="nano">
            <div class="nano-content">
                <span class="nk-news-box-item-categories">
                    <span class="bg-main-4"></span>
                </span>

                <div class="nk-gap-2"></div>
                <h3 class="nk-news-box-item-title"></h3>

                <div class="nk-news-box-item-text">
                    <p></p>
                </div>

                <a href="#" class="nk-news-box-item-more">Подробнее</a>

                <div class="nk-news-box-item-date">
                    <span class="fa fa-calendar"></span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="nk-gap"></div>