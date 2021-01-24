<?php

/* @var $model LootBox|Bookmaker|Casino */

use app\enums\CurrenciesEnum;
use app\models\{LootBox, Bookmaker, Casino};

?>

<?php if ($model->currencies && sizeof($model->currencies)): ?>
    <p class="mb-0">Валюты:
        <?php foreach ($model->currencies as $currency): ?>
            <span class="text-white" title="<?= CurrenciesEnum::label($currency) ?>">
                <?= CurrenciesEnum::font($currency) ?>
            </span>
        <?php endforeach; ?>
    </p>
<?php endif; ?>
