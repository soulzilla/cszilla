<?php

namespace app\widgets\pager;

use yii\bootstrap4\Widget;

class Pager extends Widget
{
    public $pagination;

    public function run()
    {
        return $this->render('index', [
            'pagination' => $this->pagination
        ]);
    }
}
