<?php

namespace app\widgets\comments;

use app\models\Bookmaker;
use app\models\Casino;
use app\models\Comment;
use app\models\Contest;
use app\models\LootBox;
use app\models\Publication;
use yii\bootstrap4\Widget;

class Comments extends Widget
{
    public $tableName = null;

    public function run()
    {
        $query = Comment::find()->where([
            'is_deleted' => 0,
            'is_blocked' => 0,
        ])->andWhere([
            'is', 'parent_id', null
        ])->joinWith([
            'author'
        ])->orderBy([
            'ts' => SORT_DESC
        ])->limit(5);

        if ($this->tableName) {
            $query->andWhere(['entity_table' => $this->tableName]);
            switch ($this->tableName) {
                case Publication::tableName():
                    $query->with(['publication']);
                    break;
                case Bookmaker::tableName():
                    $query->with(['bookmaker']);
                    break;
                case Casino::tableName():
                    $query->with(['casino']);
                    break;
                case LootBox::tableName():
                    $query->with(['lootBox']);
                    break;
                case Contest::tableName():
                    $query->with(['contest']);
                    break;
            }
        } else {
            $query->with([
                'publication', 'bookmaker', 'casino', 'lootBox', 'contest'
            ]);
        }

        $models = $query->all();

        return $this->render('index', [
            'models' => $models
        ]);
    }
}
