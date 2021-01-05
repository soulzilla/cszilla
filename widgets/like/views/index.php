<?php

use app\components\core\ActiveRecord;

/* @var $model ActiveRecord */

?>

<div class="w-100"
     style="position: absolute; bottom: 0; left: 0">
    <hr/>
    <div class="like-container">
        <a class="like-it pointer"
           href="javascript:void(0)"
           data-table="<?= $model->tableName() ?>"
           data-id="<?= $model->getPrimaryKey() ?>">
            <i class="fa fa-<?= $model->like ? 'heart' : 'heart-o' ?>" id="like-state-<?= $model->id ?>"></i>
            <span class="text-white ml-1" id="likes-count-<?= $model->id ?>"><?= $model->counter->likes ?></span>
        </a>
    </div>
</div>
