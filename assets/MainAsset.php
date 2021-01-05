<?php

namespace app\assets;

use yii\web\AssetBundle;

class MainAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/magnific-popup.css',
        'css/owl.carousel.min.css',
        'css/animate.css',
        'css/slicknav.min.css',
        'css/style.css'
    ];

    public $js = [
        'js/jquery.slicknav.js',
        'js/owl.carousel.min.js',
        'js/circle-progress.min.js',
        'js/jquery.magnific-popup.min.js',
        'js/main.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
        '\rmrevin\yii\fontawesome\AssetBundle'
    ];
}
