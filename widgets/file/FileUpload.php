<?php

namespace app\widgets\file;

use yii\bootstrap4\Widget;

class FileUpload extends Widget
{
    public $entity;
    public $attribute;
    public $accept = '*';

    public function run()
    {
        return $this->render('index', [
            'model' => $this->entity,
            'attribute' => $this->attribute,
            'accept' => $this->accept
        ]);
    }
}
