<?php

/* @var $models app\models\Video[] */
?>

<?php if (sizeof($models)): ?>
    <?php foreach ($models as $model): ?>
        <iframe class="mw-100"
                src="<?= $model->getEmbedUrl() ?>"
                height="auto"
                title="<?= $model->description ?>"
                frameborder="false"
                allowfullscreen="true"
                width="auto">
        </iframe>
    <?php endforeach; ?>
<?php else: ?>
    <p>
        Видео пока нет.
    </p>
<?php endif; ?>