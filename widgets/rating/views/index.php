<?php

/** @var Casino|Bookmaker|LootBox $model */

use app\models\{Bookmaker, Casino, LootBox};

?>

<div class="rating-area-<?= $model->tableName() ?>-<?= $model->id ?> nk-rating">
    <?php if (Yii::$app->user->isGuest === false): ?>
        <?php $rate = $model->rating ? $model->rating->rate : 0 ?>
            <?php for ($i = 5; $i > 0; $i--): ?>
                <input type="radio"
                       class="rate-it"
                       id="review-rate-<?= $model->tableName() ?>-<?= $model->id ?>-<?= $i ?>" <?= ($rate && ($rate == $i)) ? 'checked' : '' ?>
                       name="rating-<?= $model->tableName() ?>-<?= $model->id ?>"
                       data-id="<?= $model->id ?>"
                       data-table="<?= $model->tableName() ?>"
                       value="<?= $i ?>">
                <label class="nk-rating-label" for="review-rate-<?= $model->tableName() ?>-<?= $model->id ?>-<?= $i ?>">
                    <span><i class="far fa-star"></i></span>
                    <span><i class="fa fa-star"></i></span>
                </label>
            <?php endfor; ?>
    <?php else: ?>
        <?php for ($i = 5; $i > 0; $i--): ?>
            <input type="radio"
                   class="rate-it"
                   id="review-rate-<?= $i ?>"
                   name="rating"
                   data-toggle="modal"
                   data-target="#auth-modal"
                   value="<?= $i ?>">
            <label class="nk-rating-label" for="review-rate-<?= $i ?>">
                <span><i class="far fa-star"></i></span>
                <span><i class="fa fa-star"></i></span>
            </label>
        <?php endfor; ?>
    <?php endif; ?>
</div>
