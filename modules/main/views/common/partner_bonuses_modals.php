<?php

/* @var $model LootBox|Bookmaker|Casino */

use app\models\{LootBox, Bookmaker, Casino};

?>

<?php if (sizeof($model->bonuses)): ?>
    <?php foreach ($model->bonuses as $bonus): ?>
        <div class="nk-modal modal fade" id="bonus-<?= $bonus->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span class="ion-android-close"></span>
                        </button>

                        <div class="nk-gap-2"></div>

                        <?= $bonus->description ?>

                        <?= $bonus->rules ?>

                        <?php if ($bonus->url): ?>
                            <div class="mt-3">
                                <a target="_blank" class="nk-btn nk-btn-rounded nk-btn-color-white nk-btn-block nk-btn-hover-color-main-1"
                                   href="<?= $bonus->url ?>">
                                    Получить
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
