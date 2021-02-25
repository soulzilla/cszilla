<?php

use app\models\CustomTeam;

/** @var $models CustomTeam[] */
?>

<?php foreach ($models as $model): ?>
    <div class="col-md-4">
        <div class="nk-box-2 bg-dark-2 p-20">
            <h4><?= $model->name ?></h4>
            <?php foreach ($model->players as $player): ?>
                <p><a href="<?= $player->steam_url ?>" target="_blank" rel="nofollow"><?= $player->name ?></a></p>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>
