<?php

use app\components\helpers\StringHelper;
use app\models\Comment;

/** @var $models Comment[] */
?>

<?php if (sizeof($models)): ?>
    <?php foreach ($models as $model): ?>
        <li id="comment-<?= $model->id ?>">
            <div class="row">
                <div class="comment-text col-auto pr-0">
                    <h6><?= $model->author->name ?></h6>
                    <div class="comment-date"><?= StringHelper::humanize($model->ts) ?></div>
                    <p class="text-break"><?= $model->content ?></p>
                </div>
                <?php if ($model->canDelete()): ?>
                    <div class="ml-auto mr-3">
                        <a href="javascript:void(0)" class="delete-comment"
                           data-id="<?= $model->id ?>">
                            <i class="fa fa-times text-danger"></i>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </li>
    <?php endforeach; ?>
<?php endif; ?>
