<?php

namespace app\widgets\nav;

use yii\bootstrap4\Widget;

class Nav extends Widget
{
    public $items;

    public function run()
    {
        return $this->render('index', [
            'items' => $this->items
        ]);
    }
}
