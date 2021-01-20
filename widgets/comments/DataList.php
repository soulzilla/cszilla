<?php

namespace app\widgets\comments;

use app\models\Bookmaker;
use app\models\Casino;
use app\models\LootBox;
use yii\base\Widget;

class DataList extends Widget
{
    /** @var Bookmaker|Casino|LootBox */
    public $model;

    public function run()
    {
        return $this->render('list', [
            'model' => $this->model
        ]);
    }
}
