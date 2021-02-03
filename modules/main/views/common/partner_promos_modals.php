<?php

/* @var $model LootBox|Bookmaker|Casino */

use app\models\{LootBox, Bookmaker, Casino};

?>

<?php if (sizeof($model->promoCodes)): ?>
    <?php foreach ($model->promoCodes as $promoCode): ?>
        <div class="nk-modal modal fade" id="promo-<?= $promoCode->id ?>" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                            <span class="ion-android-close"></span>
                        </button>

                        <div class="nk-gap-2"></div>

                        <div class="text-center">
                            <p class="lead"><?= $promoCode->code ?></p>
                        </div>

                        <?= $promoCode->description ?>

                        <?php if ($promoCode->url): ?>
                            <div class="mt-3 text-center">
                                <a target="_blank" class="nk-btn nk-btn-rounded nk-btn-color-white nk-btn-hover-color-main-1"
                                   href="<?= $promoCode->url ?>">
                                    Активировать
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
