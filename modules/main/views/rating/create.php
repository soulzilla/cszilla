<?php

use app\models\Rating;

/** @var $model Rating */
?>

<?php for ($i = 5; $i > 0; $i--): ?>
    <input type="radio"
           class="rate-it"
           id="star-<?= $model->entity_table ?>-<?= $model->entity_id ?>-<?= $i ?>" <?= ($model->rate && ($model->rate == $i)) ? 'checked' : '' ?>
           name="rating<?= $model->entity_table ?>-<?= $model->entity_id ?>"
           data-id="<?= $model->entity_id ?>"
           data-table="<?= $model->entity_table ?>"
           value="<?= $i ?>">
    <label for="star-<?= $model->entity_table ?>-<?= $model->entity_id ?>-<?= $i ?>" title="Оценка «<?= $i ?>»"></label>
<?php endfor; ?>
