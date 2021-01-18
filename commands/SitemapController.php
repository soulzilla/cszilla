<?php

namespace app\commands;

use app\models\Sitemap;
use Yii;
use yii\console\Controller;

class SitemapController extends Controller
{
    public function actionIndex()
    {
        Yii::$app->cache->delete('cszilla.sitemap');

        /** @var Sitemap[] $models */
        $models = Sitemap::find()->orderBy(['entity_table' => SORT_ASC])->all();

        $host = 'https://cszilla.ru';

        $file = $this->renderPartial('@app/components/templates/sitemap', [
            'items' => $models,
            'host' => $host
        ]);

        Yii::$app->cache->set('cszilla.sitemap', $file, 12*60*60);
    }
}
