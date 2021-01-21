<?php /** @var app\models\Stream $model */ ?>

<?php if ($model->id): ?>
    <iframe class="mw-100"
            src="<?= $model->getEmbedUrl() ?>"
            height="auto"
            frameborder="false"
            allowfullscreen="true"
            title="<?= $model->description ?>"
            width="auto">
    </iframe>
<?php else: ?>
    <p>
        Активных стримов пока нет.
    </p>
<?php endif; ?>
