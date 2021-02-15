<?php

namespace app\assets;

use yii\web\AssetBundle;
use yii\web\YiiAsset;

class MainAsset extends AssetBundle
{
    public $sourcePath = '@app/bundles/main';

    public $css = [
        'vendor/bootstrap/dist/css/bootstrap.min.css',
        'vendor/ionicons/css/ionicons.min.css',
        'vendor/flickity/dist/flickity.min.css',
        'vendor/photoswipe/dist/photoswipe.css',
        'vendor/photoswipe/dist/default-skin/default-skin.css',
        'vendor/bootstrap-slider/dist/css/bootstrap-slider.min.css',
        'vendor/summernote/dist/summernote-bs4.css',
        'css/main.css',
        'css/custom.css'
    ];

    public $js = [
        'vendor/fontawesome-free/js/all.js',
        'vendor/fontawesome-free/js/v4-shims.js',
        //'vendor/jquery/dist/jquery.min.js',
        'vendor/object-fit-images/dist/ofi.min.js',
        'vendor/gsap/src/minified/TweenMax.min.js',
        'vendor/gsap/src/minified/plugins/ScrollToPlugin.min.js',
        'vendor/popper.js/dist/umd/popper.min.js',
        'vendor/bootstrap/dist/js/bootstrap.min.js',
        'vendor/sticky-kit/dist/sticky-kit.min.js',
        'vendor/jarallax/dist/jarallax.min.js',
        'vendor/jarallax/dist/jarallax-video.min.js',
        'vendor/imagesloaded/imagesloaded.pkgd.min.js',
        'vendor/flickity/dist/flickity.pkgd.min.js',
        'vendor/photoswipe/dist/photoswipe.min.js',
        'vendor/photoswipe/dist/photoswipe-ui-default.min.js',
        'vendor/jquery-validation/dist/jquery.validate.min.js',
        'vendor/jquery-countdown/dist/jquery.countdown.min.js',
        'vendor/moment/min/moment.min.js',
        'vendor/moment-timezone/builds/moment-timezone-with-data.min.js',
        'vendor/hammerjs/hammer.min.js',
        'vendor/nanoscroller/bin/javascripts/jquery.nanoscroller.js',
        'vendor/soundmanager2/script/soundmanager2-nodebug-jsmin.js',
        'vendor/bootstrap-slider/dist/bootstrap-slider.min.js',
        'vendor/summernote/dist/summernote-bs4.min.js',
        'plugins/nk-share/nk-share.js',
        'js/main.min.js',
        'js/main-init.js',
        'https://embed.twitch.tv/embed/v1.js'
    ];

    public $depends = [
        YiiAsset::class
    ];
}
