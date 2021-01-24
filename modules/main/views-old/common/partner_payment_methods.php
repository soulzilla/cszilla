<?php

/* @var $model LootBox|Bookmaker|Casino */

use app\enums\PaymentMethodsEnum;
use app\models\{LootBox, Bookmaker, Casino};

?>

<?php if ($model->payment_methods && sizeof($model->payment_methods)): ?>
    <p class="mb-0">Методы оплаты:
        <?php foreach ($model->payment_methods as $payment_method): ?>
            <span class="text-white mx-1" title="<?= PaymentMethodsEnum::label($payment_method) ?>">
                <?= PaymentMethodsEnum::font($payment_method) ?>
            </span>
        <?php endforeach; ?>
    </p>
<?php endif; ?>
