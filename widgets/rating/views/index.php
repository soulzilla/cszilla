<?php

/** @var Casino|Bookmaker|LootBox $model */

use app\models\{Bookmaker, Casino, LootBox};

?>

<div class="rating-area">
    <?php if (Yii::$app->user->isGuest === false): ?>
        <?php $rate = $model->rating ? $model->rating->rate : 0 ?>
            <?php for ($i = 5; $i > 0; $i--): ?>
                <input type="radio"
                       class="rate-it"
                       id="star-<?= $i ?>" <?= ($rate && ($rate == $i)) ? 'checked' : '' ?>
                       name="rating"
                       data-id="<?= $model->id ?>"
                       data-table="<?= $model->tableName() ?>"
                       value="<?= $i ?>">
                <label for="star-<?= $i ?>" title="Оценка «<?= $i ?>»"></label>
            <?php endfor; ?>
    <?php else: ?>
        <?php for ($i = 5; $i > 0; $i--): ?>
            <input type="radio"
                   class="rate-it"
                   id="star-<?= $i ?>"
                   name="rating"
                   data-toggle="modal"
                   data-target="#auth-modal"
                   value="<?= $i ?>">
            <label for="star-<?= $i ?>" title="Оценка «<?= $i ?>»"></label>
        <?php endfor; ?>
    <?php endif; ?>
</div>
