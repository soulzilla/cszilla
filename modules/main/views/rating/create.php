<?php

use app\models\Rating;

/** @var $model Rating */
?>

<?php for ($i = 1; $i <= 5; $i++): ?>
    <a href="javascript:void(0)"
       class="rate-it"
       data-rate="<?= $i ?>"
       data-id="<?= $model->entity_id ?>" data-table="<?= $model->entity_table ?>">
        <i class="fa fa-star<?= ($i <= $model->rate) ? '' : '-o' ?>"></i>
    </a>
<?php endfor; ?>
