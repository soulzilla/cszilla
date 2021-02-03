<?php

namespace app\widgets\preloader;

use yii\bootstrap4\Widget;

class Preloader extends Widget
{
    public function run()
    {
        return $this->render('index');
    }
}