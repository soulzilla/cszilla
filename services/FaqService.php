<?php

namespace app\services;

use app\components\core\Service;
use app\models\Faq;

class FaqService extends Service
{
    public function getModel()
    {
        return new Faq();
    }
}
