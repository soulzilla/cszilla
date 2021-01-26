<?php
/** @var $models app\models\Review[] */
$models = [];
?>

<div class="nk-gap-2"></div>

<h3 class="nk-decorated-h-2"><span>Отзывы</span></h3>
<div class="nk-gap"></div>

<?php if (sizeof($models)): $first = array_key_first($models); ?>
    <div class="nk-carousel" <?= sizeof($models) > 1 ? 'data-autoplay="6000"' : '' ?>>
        <div class="nk-carousel-inner">
            <?php foreach ($models as $key => $model): ?>
                <blockquote class="nk-blockquote w-100">
                    <div class="nk-blockquote-icon"><span>"</span></div>
                    <div class="nk-blockquote-content">
                        <?= $model->content ?>
                    </div>
                    <div class="nk-blockquote-author"><span><?= $model->author->name ?></span></div>
                </blockquote>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>

<div class="text-right">
    <a href="#" data-toggle="modal" data-target="#<?= Yii::$app->user->isGuest ? 'auth' : 'review' ?>-modal" class="nk-btn nk-btn-rounded nk-btn-color-white nk-btn-hover-color-main-1">
        Оставить отзыв
    </a>
</div>

<div class="nk-gap-2"></div>