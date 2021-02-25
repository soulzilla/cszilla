<?php

/** @var $models app\models\TournamentTeam[] */
?>

<?php foreach ($models as $model): ?>
    <div class="col-md-4">
        <div class="nk-box-2 bg-dark-2 p-20">
            <h4><?= $model->team->name ?></h4>
            <?php foreach ($model->team->players as $player): ?>
                <p><a href="<?= $player->steam_url ?>" target="_blank" rel="nofollow"><?= $player->name ?></a></p>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>
