<?php

/* @var $models app\models\Banner[] */
?>

<?php if (sizeof($models)): ?>
    <div class="nk-gap"></div>
    <div class="nk-image-slider" <?= sizeof($models) > 1 ? 'data-autoplay="8000"' : '' ?>>
        <?php foreach ($models as $model): ?>
            <div class="nk-image-slider-item">
                <?php if ($model->background_image): ?>
                    <img src="<?= $model->background_image ?>" alt="<?= $model->background_image ?>" class="nk-image-slider-img"
                         data-thumb="<?= $model->background_image ?>">
                <?php endif ?>
                <div class="nk-image-slider-content">
                    <h3 class="h4"><?= $model->title ?></h3>
                    <div class="text-white"><?= $model->content ?></div>
                    <a href="<?= $model->url ?>" class="nk-btn nk-btn-rounded nk-btn-color-white nk-btn-hover-color-main-1">
                        Подробнее
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
