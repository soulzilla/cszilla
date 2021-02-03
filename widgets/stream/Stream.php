<?php

namespace app\widgets\stream;

use yii\bootstrap4\Widget;
use app\models\Stream as Model;

class Stream extends Widget
{
    public function run()
    {
        $model = Model::find()
            ->where(['is_finished' => 0])
            ->orderBy(['ts' => SORT_DESC])
            ->cache(300)
            ->one();

        if (!$model) {
            $model = new Model();
        }

        return $this->render('index', [
            'model' => $model
        ]);
    }
}
