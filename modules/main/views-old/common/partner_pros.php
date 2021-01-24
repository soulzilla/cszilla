<?php

/* @var $model LootBox|Bookmaker|Casino */

use app\models\{LootBox, Bookmaker, Casino};

?>

<?php if ($model->hasPros() && $model->hasCons()): ?>
    <div class="row">
        <div class="col-6">
            <h4 class="text-white mb-3">Плюсы</h4>
            <?php foreach ($model->pros as $pro): ?>
                <p class="text-break">
                    <i class="fa fa-plus-circle"></i>
                    <?= $pro ?>
                </p>
            <?php endforeach; ?>
        </div>

        <div class="col-6">
            <h4 class="text-white mb-3">Минусы</h4>
            <?php foreach ($model->cons as $con): ?>
                <p class="text-break">
                    <i class="fa fa-minus-circle"></i>
                    <?= $con ?>
                </p>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>