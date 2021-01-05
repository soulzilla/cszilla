<?php

namespace app\services;

use app\components\core\Service;
use app\models\Video;

class VideosService extends Service
{
    public function getModel()
    {
        return new Video();
    }
}