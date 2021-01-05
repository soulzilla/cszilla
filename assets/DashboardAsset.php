<?php

namespace app\assets;

use yii\web\AssetBundle;

class DashboardAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];

    public $js = [
        'js/dashboard.js'
    ];

    public $depends = [
        'yii\web\YiiAsset',
        '\rmrevin\yii\fontawesome\AssetBundle'
    ];
}