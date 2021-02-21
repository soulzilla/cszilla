<?php

namespace app\widgets\videos;

use app\models\Video;
use yii\bootstrap4\Widget;

class Videos extends Widget
{
    public function run()
    {
        $models = Video::find()
            ->where(['is_published' => 1])
            ->limit(3)
            ->cache(300)
            ->orderBy(['ts' => SORT_DESC])
            ->all();

        return $this->render('index', [
            'models' => $models
        ]);
    }
}
