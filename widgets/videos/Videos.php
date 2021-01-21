<?php

namespace app\widgets\videos;

use yii\bootstrap4\Widget;

class Videos extends Widget
{
    public function run()
    {
        return $this->render('index');
    }
}
