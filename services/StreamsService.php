<?php

namespace app\services;

use app\components\core\Service;
use app\models\Stream;

class StreamsService extends Service
{
    public function getModel()
    {
        return new Stream();
    }
}