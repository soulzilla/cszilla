<?php
/* @var $model app\traits\CounterTrait */

use app\enums\AttachmentsEnum;

?>


<?php if (sizeof($model->attachedItems)): ?>
    <h2 class="nk-decorated-h-2 h3"><span>Галерея</span></h2>
    <div class="nk-gap"></div>
    <div class="nk-popup-gallery">
        <div class="row vertical-gap">
            <?php foreach ($model->attachedItems as $attachment): ?>
                <?php if ($attachment->type == AttachmentsEnum::TYPE_IMAGE): ?>
                    <div class="col-md-6">
                        <div class="nk-gallery-item-box">
                            <a href="<?= $attachment->source ?>" class="nk-gallery-item">
                                <div class="nk-gallery-item-overlay"><span class="ion-eye"></span></div>
                                <img src="<?= $attachment->source ?>" alt="">
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="col-md-6">
                        <div class="nk-plain-video" data-video="<?= $attachment->source ?>"></div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
    <div class="nk-gap-2"></div>
<?php endif; ?>
