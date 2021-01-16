<?php

namespace app\services;

use app\components\core\Service;
use app\models\Sitemap;

class SitemapService extends Service
{
    public function getModel()
    {
        return new Sitemap();
    }

    public function generate()
    {

    }
}
