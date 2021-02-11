<?php

namespace app\services;

use app\components\core\Service;
use app\models\Page;

class PagesService extends Service
{
    public function getModel()
    {
        return new Page();
    }
}
