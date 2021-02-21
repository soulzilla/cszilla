<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\models\Sitemap;
use app\services\SitemapService;
use app\services\UsersService;
use Yii;

class SitemapController extends DashboardController
{
    public function __construct($id, $module, UsersService $usersService, SitemapService $service, $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }

    public function actionRefresh()
    {
        Yii::$app->cache->delete('cszilla.sitemap');
        $models = Sitemap::find()->orderBy(['entity_table' => SORT_ASC])->all();
        $host = 'https://cszilla.ru';

        $file = $this->renderPartial('@app/components/templates/sitemap', [
            'items' => $models,
            'host' => $host
        ]);

        Yii::$app->cache->set('cszilla.sitemap', $file, 12*60*60);

        return $this->redirect(['index']);
    }
}
