<?php

use app\models\Rating;

/** @var $model Rating */
?>

<?php for ($i = 5; $i > 0; $i--): ?>
    <input type="radio"
           class="rate-it"
           id="star-<?= $model->tableName() ?>-<?= $model->id ?>-<?= $i ?>" <?= ($model->rate && ($model->rate == $i)) ? 'checked' : '' ?>
           name="rating<?= $model->tableName() ?>-<?= $model->id ?>"
           data-id="<?= $model->id ?>"
           data-table="<?= $model->tableName() ?>"
           value="<?= $i ?>">
    <label for="star-<?= $model->tableName() ?>-<?= $model->id ?>-<?= $i ?>" title="Оценка «<?= $i ?>»"></label>
<?php endfor; ?>
