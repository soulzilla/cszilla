<?php /* @var $pagination Pagination */

use app\components\helpers\Url;
use yii\data\Pagination;

$currentPage = $pagination->getPage() + 1;

$totalPages = $pagination->getPageCount();
?>

<?php if ($totalPages > 1): ?>
<div class="site-pagination">
    <?php if ($currentPage != 1): ?>
        <a href="<?= Url::current(['page' => 1]) ?>" class="sp-prev"><<<</a>
        <a href="<?= Url::current(['page' => $currentPage-1]) ?>" class="sp-prev"><<</a>
    <?php endif; ?>

    <?php for ($i = $currentPage; $i <= $totalPages; $i++): ?>
        <a href="<?= Url::current(['page' => $i]) ?>" class="<?= $currentPage == $i ? 'active' : '' ?>">
            <?= $i < 10 ? '0' . $i : $i ?>.
        </a>
    <?php endfor; ?>

    <?php if ($currentPage != $totalPages): ?>
        <a href="<?= Url::current(['page' => $currentPage+1]) ?>" class="sp-next">>></a>
        <a href="<?= Url::current(['page' => $totalPages]) ?>" class="sp-next">>>></a>
    <?php endif; ?>
</div>
<?php endif; ?>
