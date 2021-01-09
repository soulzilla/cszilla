<?php

/* @var $this View */
/* @var $content string */

use app\widgets\footer\Footer;
use app\widgets\nav\Nav;
use app\widgets\tickers\Tickers;
use yii\helpers\Html;
use app\assets\MainAsset;
use yii\web\View;
use yii\widgets\Pjax;
use yii\widgets\PjaxAsset;

MainAsset::register($this);
PjaxAsset::register($this);
?>

<?php Pjax::begin() ?>
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
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i&display=swap" rel="stylesheet">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<?php Pjax::begin() ?>
<body>
<?php $this->beginBody() ?>
    <header class="header-section">
        <?= Nav::widget([
            'items' => [
                'news' => [
                    'name' => 'Новости',
                    'url' => '/news'
                ],
                'giveaways' => [
                    'name' => 'Розыгрыши',
                    'url' => '/giveaways'
                ],
                'casinos' => [
                    'name' => 'Казино',
                    'url' => '/casinos'
                ],
                'loot-boxes' => [
                    'name' => 'Лутбоксы',
                    'url' => '/loot-boxes'
                ],
                'bookmakers' => [
                    'name' => 'Букмекеры',
                    'url' => '/bookmakers'
                ],
            ]
        ]) ?>
    </header>
    <div class="container">
        <?= Tickers::widget() ?>
    </div>

    <?= $content ?>

    <?= Footer::widget() ?>

    <?php $this->endBody() ?>
</body>
<?php Pjax::end() ?>
</html>
<?php $this->endPage() ?>
<?php Pjax::end() ?>

