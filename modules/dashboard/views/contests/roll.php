<?php

/* @var $model Contest */

use app\models\Contest;

$this->title = 'Итоги розыгрыша от ' . $model->date_start . ' - ' . $model->date_end;
?>

<div class="contest-roll row">
    <?php for ($i = 1; $i <= $model->winners_count; $i++): ?>
        <div class="col-12" style="margin: 1rem" id="winner-<?= $i ?>">
            <?php if ($winner = $model->getWinnerByPlace($i)): ?>
                <span><?= $winner->user->name ?></span>
            <?php else: ?>
                <a class="roll btn btn-primary"
                   href="javascript:void(0)"
                   data-contest="<?= $model->id ?>"
                   data-place="<?= $i ?>">
                    Место <?= $i ?>
                </a>
            <?php endif; ?>
        </div>
    <?php endfor; ?>
</div>
