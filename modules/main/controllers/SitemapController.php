<?php

namespace app\modules\main\controllers;

use app\components\core\Controller;
use app\models\Sitemap;
use Yii;
use yii\web\Response;

class SitemapController extends Controller
{
    public function actionIndex()
    {
        $file = Yii::$app->cache->get('cszilla.sitemap');

        if (!$file) {
            $models = Sitemap::find()->orderBy(['entity_table' => SORT_ASC])->all();

            $host = 'https://cszilla.ru';

            $file = $this->renderPartial('@app/components/templates/sitemap', [
                'items' => $models,
                'host' => $host
            ]);

            Yii::$app->cache->set('cszilla.sitemap', $file, 12*60*60);
        }

        Yii::$app->response->format = Response::FORMAT_RAW;
        Yii::$app->response->headers->add('Content-Type', 'text/xml');

        return $file;
    }
}
