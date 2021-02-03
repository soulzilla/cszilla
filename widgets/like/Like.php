<?php

namespace app\widgets\like;

use yii\bootstrap4\Widget;

class Like extends Widget
{
    public $entity;
    public $template = 'index';

    public function run()
    {
        return $this->render($this->template, [
            'model' => $this->entity
        ]);
    }
}
