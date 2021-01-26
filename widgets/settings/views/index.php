<?php

/** @var $models app\models\Bookmaker[] */
/** @var $title string */
/** @var $type string */
/** @var $help string */
?>

<h3 class="nk-decorated-h-2"><span><?= $title ?></span></h3>

<?php if (sizeof($models)): ?>
    <div class="col-lg-6">
        <table class="nk-table">
            <thead>
                <tr>
                    <th colspan="2"><?= $help ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($models as $model): ?>
                    <tr>
                        <th class="w-75"><?= $model->name ?></th>
                        <th class="text-center">
                            <label class="switch-label">
                                <input class="settings-select" data-id="<?= $model->id ?>" data-type="<?= $type ?>"
                                       type="checkbox" <?= $model->observer ? 'checked' : '' ?>>
                                <span class="switch-input round"></span>
                            </label>
                        </th>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="nk-gap"></div>
    </div>
<?php endif; ?>
