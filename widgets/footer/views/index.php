<?php /* @var $links app\models\StaticBlock[] */

use app\enums\StaticBlockEnum; ?>

<div class="footer-section">
    <div class="social-links-warp">
        <div class="container">
            <div class="social-links">
                <?php foreach ($links as $link): ?>
                    <a href="<?= $link->content ?>">
                        <i class="fa fa-<?= $link->getIcon() ?>"></i>
                        <span><?= StaticBlockEnum::label($link->type) ?></span>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
