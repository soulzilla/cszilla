<?php /* @var $links app\models\StaticBlock[] */?>

<footer class="nk-footer">
    <div class="nk-copyright">
        <div class="container">
            <div class="nk-copyright-right">
                <div class="nk-gap d-block d-lg-none"></div>
                <ul class="nk-social-links-2">
                    <?php foreach ($links as $link): ?>
                        <li>
                            <a target="_blank" class="nk-social-<?= $link->getIcon() ?>" href="<?= $link->content ?>">
                                <span class="fa fa-<?= $link->getIcon() ?>"></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</footer>
