<?php

/** @var $models app\models\GameMatch[] */

if (sizeof($models)): ?>
    <h3 class="nk-decorated-h-2"><span><span class="text-main-1">Актуальные</span> матчи</span></h3>
    <div class="nk-gap"></div>

    <?php foreach ($models as $model): ?>
        <?= $this->render('@app/modules/main/views/match-center/_match_item', ['model' => $model]) ?>
    <?php endforeach; ?>

    <div class="nk-gap-2"></div>

<?php endif; ?>