<?php
/** @var $flashes array */
?>

<?php if (sizeof($flashes)): ?>
    <?php foreach ($flashes as $key => $message): ?>
        <div class="nk-info-box nk-info-box-noicon">
            <div class="nk-info-box-close nk-info-box-close-btn">
                <i class="ion-close-round"></i>
            </div>
            <em class="text-<?= $key ?>"><?= $message ?></em>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
