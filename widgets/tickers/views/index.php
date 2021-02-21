<?php

/* @var $models app\models\Ticker[] */

?>

<?php if (sizeof($models)): ?>
    <div class="nk-gap-2"></div>
    <div class="nk-carousel" <?= sizeof($models) > 1 ? 'data-autoplay="6000"' : '' ?>>
        <div class="nk-carousel-inner">
            <?php foreach ($models as $model): ?>
                <div class="mw-100 px-3 mr-0 nk-feature-1">
                    <div class="text-left">
                        <?= $model->content ?>
                    </div>
                    <div class="text-right">
                        <a class="nk-btn nk-btn-rounded nk-btn-color-main-1"
                           href="<?= $model->url ?>" <?= $model->target ? 'target="_blank"' : '' ?>>
                            Перейти
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
