<?php

use app\models\TournamentTeam;

/** @var $models TournamentTeam[] */
?>

<?php foreach ($models as $model): ?>
    <div class="col-md-4">
        <div class="nk-box-2 bg-dark-2 p-20">
            <a rel="nofollow" href="<?= $model->profile->steam_url ?>" target="_blank">
                <h4 class="mb-0"><?= $model->profile->name ?></h4>
            </a>
        </div>
    </div>
<?php endforeach; ?>
