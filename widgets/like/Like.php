<?php

namespace app\widgets\like;

use yii\bootstrap4\Widget;

class Like extends Widget
{
    public $entity;

    public function run()
    {
        return $this->render('index', [
            'model' => $this->entity
        ]);
    }
}
