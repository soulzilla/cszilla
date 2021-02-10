<?php
/* @var $model GameMatch */

use app\components\helpers\StringHelper;
use app\models\GameMatch;

?>

<div class="nk-match" id="match-<?= $model->id ?>">
    <div class="nk-match-team-left" <?= $model->isWinner($model->first_team) ? 'border border-success' : '' ?>>
        <a href="javascript:void(0)" class="<?= $model->canPredict() ? 'predict' : '' ?>" data-id="<?= $model->id ?>" data-team-id="<?= $model->first_team ?>">
            <span class="nk-match-team-logo">
                <img src="<?= $model->firstTeam->logo ?>" alt="" width="90">
            </span>
            <span class="nk-match-team-name <?= $model->predictionStatus($model->first_team) ?>" id="match-<?= $model->id ?>-team-<?= $model->first_team ?>"><?= $model->firstTeam->name ?></span>
        </a>
    </div>
    <div class="nk-match-status">
        <span class="nk-match-status-vs">VS</span>
        <span class="nk-match-status-date"><?= StringHelper::humanize($model->start_ts) ?></span>
        <?php if (strtotime($model->start_ts) < time() && !$model->is_finished): ?>
            <?php if ($model->is_finished && $model->final_score): ?>
                <span class="nk-match-score bg-danger">Live</span>
            <?php endif; ?>
        <?php endif; ?>
        <?php if ($model->is_finished && $model->final_score): ?>
            <span class="nk-match-score bg-dark-1"><?= $model->final_score ?></span>
        <?php endif; ?>
    </div>
    <div class="nk-match-team-right <?= $model->isWinner($model->second_team) ? 'border border-success' : '' ?>">
        <a href="javascript:void(0)" class="<?= $model->canPredict() ? 'predict' : '' ?>" data-id="<?= $model->id ?>" data-team-id="<?= $model->second_team ?>">
            <span class="nk-match-team-name <?= $model->predictionStatus($model->second_team) ?>" id="match-<?= $model->id ?>-team-<?= $model->second_team ?>">
                <?= $model->secondTeam->name ?>
            </span>
            <span class="nk-match-team-logo">
                <img src="<?= $model->secondTeam->logo ?>" alt="" width="90">
            </span>
        </a>
    </div>
</div>
