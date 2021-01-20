<?php

namespace app\widgets\rating;

use app\models\Bookmaker;
use app\models\Casino;
use app\models\LootBox;
use yii\bootstrap4\Widget;

class Rating extends Widget
{
    /** @var Casino|Bookmaker|LootBox */
    public $model;

    public function run()
    {
        return $this->render('index', [
            'model' => $this->model
        ]);
    }
}
