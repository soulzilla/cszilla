<?php

/* @var $this yii\web\View */
/* @var $code */
/* @var $message */
/* @var $socialLinks app\models\StaticBlock[] */

use app\components\helpers\Url;

?>

<div class="nk-fullscreen-block">
    <div class="nk-fullscreen-block-middle">
        <div class="container text-center">
            <div class="row">
                <div class="col-md-6 offset-md-3 col-lg-4 offset-lg-4">
                    <h1 class="text-main-1" style="font-size: 150px;"><?= $code ?></h1>

                    <div class="nk-gap"></div>
                    <h2 class="h4"><?= $message ?></h2>

                    <div class="nk-gap-3"></div>

                    <a href="<?= Url::to(['/main/default/index']) ?>" class="nk-btn nk-btn-rounded nk-btn-color-white">
                        На главную
                    </a>
                </div>
            </div>
            <div class="nk-gap-3"></div>
        </div>
    </div>
    <div class="nk-fullscreen-block-bottom">
        <div class="nk-gap-2"></div>
        <ul class="nk-social-links-2 nk-social-links-center">
            <?php foreach ($socialLinks as $link): ?>
                <li>
                    <a target="_blank" class="nk-social-<?= $link->getIcon() ?>" href="<?= $link->content ?>">
                        <span class="fa fa-<?= $link->getIcon() ?>"></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
