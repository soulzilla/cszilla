<?php

use app\components\helpers\StringHelper;
use app\models\Complaint;

/** @var $models Complaint[] */
?>

<?php if ($models): ?>
    <?php foreach ($models as $model): ?>
        <div class="border-bottom mb-3">
            <div class="row" id="complaint-<?= $model->id ?>">
                <div class="col-10">
                    <p class="text-sm mb-0"><?= $model->author->name ?>, <?= StringHelper::humanize($model->ts) ?></p>
                    <?= nl2br($model->body) ?>
                </div>
                <div class="col-auto ml-auto">
                    <?php if ($model->canDelete()): ?>
                        <a class="delete-complaint text-danger" href="javascript:void(0)" data-id="<?= $model->id ?>">
                            <i class="fa fa-times"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
