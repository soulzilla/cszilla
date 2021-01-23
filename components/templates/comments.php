<?php

use app\components\helpers\StringHelper;
use app\models\Comment;
use app\widgets\like\Like;

/** @var $models Comment[] */
?>

<?php if (sizeof($models)): ?>
    <?php foreach ($models as $model): ?>
        <li id="comment-<?= $model->id ?>">
            <div class="row">
                <div class="comment-text col-auto pr-0">
                    <h6><?= $model->author->name ?></h6>
                    <p class="text-break"><?= nl2br($model->content) ?></p>
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
            <div class="row px-3">
                <div class="date-text"><?= StringHelper::humanize($model->ts) ?></div>
                <?= Like::widget(['entity' => $model, 'template' => 'comment']) ?>
            </div>
        </li>
    <?php endforeach; ?>
<?php endif; ?>
