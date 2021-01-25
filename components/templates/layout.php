<?php

/* @var $this View */

/* @var $content string */

use app\widgets\reviews\Reviews;
use app\widgets\search\Search;
use yii\bootstrap4\Html;
use app\widgets\footer\Footer;
use app\widgets\nav\Nav;
use app\assets\MainAsset;
use yii\web\View;

MainAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700%7cOpen+Sans:400,700" rel="stylesheet" type="text/css">
    </head>

    <body>
    <?php $this->beginBody(); ?>

    <?= Nav::widget(['currentController' => $this->context]) ?>

    <?= Search::widget() ?>

    <?php if (!Yii::$app->user->isGuest): ?>
        <?= Reviews::widget() ?>
    <?php endif; ?>

    <div class="nk-main">
        <div class="container">
            <?= $content ?>
        </div>
    </div>

    <?= Footer::widget(['currentController' => $this->context]) ?>

    <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
