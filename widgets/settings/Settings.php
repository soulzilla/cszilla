<?php

namespace app\widgets\settings;

use app\enums\EntityTablesEnum;
use app\models\Bookmaker;
use app\models\Casino;
use app\models\Category;
use app\models\LootBox;
use app\models\User;
use yii\bootstrap4\Widget;

class Settings extends Widget
{
    /** @var string */
    public $type;

    /** @var string */
    public $title;

    /** @var string */
    public $help;

    /** @var User */
    public $model;

    public function run()
    {
        /** @var Bookmaker[]|Category[]|Casino[]|LootBox[] $models */

        $class = Category::class;

        switch ($this->type) {
            case 'bookmakers':
                $class = Bookmaker::class;
                break;
            case 'casinos':
                $class = Casino::class;
                break;
            case 'loot-boxes':
                $class = LootBox::class;
                break;
            case 'categories':
                $class = Category::class;
                break;
        }

        $models = $class::find()->where([
            'is_published' => 1,
        ])->orderBy([
            'order' => SORT_ASC
        ])->all();

        $map = $this->model->profile->interesting_bookmakers ?? [];

        foreach ($models as $model) {
            if (!array_key_exists($model->id, $map)) {
                $map[$model->id] = false;
            } else {
                $map[$model->id] = $map[$model->id] == 'true';
            }
        }

        return $this->render('index', [
            'models' => $models,
            'map' => $map,
            'title' => $this->title,
            'type' => $this->type
        ]);
    }
}
