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
        ])->with(['observer'])->orderBy([
            'order' => SORT_ASC
        ])->all();

        return $this->render('index', [
            'models' => $models,
            'title' => $this->title,
            'type' => $this->type,
            'help' => $this->help
        ]);
    }
}
