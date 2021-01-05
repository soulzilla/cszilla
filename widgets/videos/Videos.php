<?php

namespace app\widgets\videos;

use app\models\Video;
use yii\bootstrap4\Widget;

class Videos extends Widget
{
    public function run()
    {
        $models = Video::find()
            ->orderBy(['ts' => SORT_DESC])
            ->limit(3)
            //->cache(300)
            ->all();

        $video = new Video();

        return $this->render('index', [
            'models' => $models,
            'video' => $video
        ]);
    }
}
