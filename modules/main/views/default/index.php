<?php

/** @var yii\web\View $this */
/** @var app\models\Publication[] $publications */
/** @var app\models\Bookmaker[] $bookmakers */
/** @var app\models\LootBox[] $lootBoxes */
/** @var app\models\Casino[] $casinos */
/** @var app\models\Review[] $reviews */

use app\components\helpers\StringHelper;
use app\widgets\banners\Banners;
use app\widgets\comments\Comments;
use app\widgets\stream\Stream;
use app\widgets\videos\Videos;

$this->title = 'CSZilla - Новости, розыгрыши, промокоды, бонусы';
$this->registerMetaTag([
    'name' => 'title',
    'content' => $this->title
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => 'CSZilla - новости, розыгрыши, промокоды, бонусы. Всё это и не только на нашем сайте.'
]);

$this->registerMetaTag([
    'name' => 'keywords',
    'content' => StringHelper::getDefaultKeywords()
]);
?>

<?= Banners::widget() ?>
<?php if (sizeof($publications)): ?>
    <?= $this->render('include/_latest_news', ['models' => $publications]) ?>
<?php endif; ?>

<div class="nk-gap"></div>
<div class="row">
    <div class="col-lg-8">
        <?= $this->render('include/_bookmakers', ['models' => $bookmakers]) ?>

        <?= $this->render('include/_casinos', ['models' => $casinos]) ?>

        <?= $this->render('include/_loot_boxes', ['models' => $lootBoxes]) ?>
    </div>

    <div class="col-lg-4">
        <aside class="nk-sidebar nk-sidebar-right nk-sidebar-sticky">
            <?= Videos::widget() ?>

            <?= Stream::widget() ?>

            <?= Comments::widget() ?>
        </aside>
    </div>
</div>

<?= $this->render('include/_reviews', ['models' => $reviews]) ?>
