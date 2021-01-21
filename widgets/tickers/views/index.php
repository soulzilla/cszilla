<?php

/* @var $models app\models\Ticker[] */

?>

<?php if (sizeof($models)): ?>
    <div class="container">
        <div class="py-3">
            <?php foreach ($models as $model): ?>

            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>