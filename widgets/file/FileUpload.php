<?php

namespace app\widgets\file;

use app\models\Gallery;
use yii\bootstrap4\Widget;

class FileUpload extends Widget
{
    public $model;
    public $attribute;

    public function run()
    {
        $gallery = new Gallery();
        return $this->render('index', [
            'model' => $this->model,
            'attribute' => $this->attribute,
            'gallery' => $gallery
        ]);
    }
}
