<?php

namespace app\modules\main\controllers;

use app\behaviors\AjaxBehavior;
use app\components\core\Controller;
use app\models\Stream;
use app\models\Video;

class VideosController extends Controller
{
    public function behaviors()
    {
        return [
            'ajax' => AjaxBehavior::class
        ];
    }

    public function actionIndex()
    {
        $models = Video::find()
            ->orderBy(['ts' => SORT_DESC])
            ->limit(3)
            //->cache(300)
            ->all();

        return [
            'html' => $this->renderPartial('index', [
                'models' => $models
            ])
        ];
    }

    public function actionStream()
    {
        $model = Stream::find()
            ->where(['is_finished' => 0])
            ->orderBy(['ts' => SORT_DESC])
            ->one();

        if (!$model) {
            $model = new Stream();
        }

        return [
            'html' => $this->renderPartial('stream', [
                'model' => $model,
            ])
        ];
    }
}
