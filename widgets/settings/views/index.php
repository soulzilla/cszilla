<?php

/** @var $models app\models\Bookmaker[] */
/** @var $map array */
/** @var $title string */
/** @var $type string */
/** @var $help string */
?>

<div class="bordered-box h-100">
    <h2 class="text-white mb-3"><?= $title ?></h2>
    <?php if (sizeof($models)): ?>
        <p class="text-white"><?= $help ?></p>
        <div class="row text-white">
            <?php foreach ($models as $model): ?>
                <div class="col-10">
                    <?= $model->name ?>
                </div>
                <div class="ml-auto">
                    <label class="switch-label">
                        <input class="bookmaker-select" data-id="<?= $model->id ?>" data-type="<?= $type ?>"
                               type="checkbox" <?= $map[$model->id] ? 'checked' : '' ?>>
                        <span class="switch-input round"></span>
                    </label>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
