<?php

/* @var $models app\models\Banner[] */
?>

<?php if (sizeof($models)): ?>
    <section class="hero-section mt-sm-3 mt-lg-0">
        <div class="hero-slider owl-carousel">
            <?php foreach ($models as $model): ?>
                <div class="hero-item set-bg" <?= $model->background_image ? 'data-setbg="<?= $model->background_image ?>"' : '' ?>>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10 offset-lg-1">
                                <h2><?= $model->title ?></h2>
                                <?= $model->content ?>
                                <?php if ($model->url): ?>
                                    <a href="<?= $model->url ?>" class="site-btn">Подробнее</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>
