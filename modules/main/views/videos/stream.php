<?php /** @var app\models\Stream $model */ ?>

<?php if ($model->id): ?>
    <script type="text/javascript">
        new Twitch.Embed("twitch-embed", {
            width: 300,
            height: 200,
            channel: "<?= $model->getChannelName() ?>",
            parent: ["cszilla.ru"],
            layout: 'video'
        });
    </script>
    <div id="twitch-embed"></div>
<?php else: ?>
    <p>
        Активных стримов пока нет.
    </p>
<?php endif; ?>
