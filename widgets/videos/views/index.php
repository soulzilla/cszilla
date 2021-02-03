<?php

/* @var $models app\models\Video[] */
?>

<?php if (sizeof($models)): ?>
    <div class="nk-widget nk-widget-highlighted">
        <h4 class="nk-widget-title"><span><span class="text-main-1">Новые</span> ролики</span></h4>
        <?php foreach ($models as $model): ?>
            <div class="nk-widget-content">
                <div class="nk-plain-video" data-video="<?= $model->url ?>"></div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
