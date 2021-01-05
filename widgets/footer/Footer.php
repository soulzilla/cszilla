<?php

namespace app\widgets\footer;

use Yii;
use yii\bootstrap4\Widget;

class Footer extends Widget
{
    public function run()
    {
        $links = Yii::$app->staticBlocksService->getSocialLinks();
        return $this->render('index', [
            'links' => $links
        ]);
    }
}