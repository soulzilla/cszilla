<?php

namespace app\modules\main\controllers;

use app\components\core\Controller;
use app\components\helpers\Url;
use Yii;
use yii\web\Response;

class SitemapController extends Controller
{
    public function actionIndex()
    {
        $file = Yii::$app->cache->get('cszilla.sitemap');

        Yii::$app->response->format = Response::FORMAT_RAW;
        Yii::$app->response->headers->add('Content-Type', 'text/xml');

        return $file;
    }
}
