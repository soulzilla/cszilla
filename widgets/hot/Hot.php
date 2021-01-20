<?php

namespace app\widgets\hot;

use app\models\Publication;
use yii\bootstrap4\Widget;

class Hot extends Widget
{
    public function run()
    {
        $publications = Publication::find()
            ->andWhere([
                'publications.is_published' => 1,
                'publications.is_deleted' => 0,
                'publications.is_blocked' => 0,
            ])->orderBy([
                'ts' => SORT_DESC
            ])->limit(4)->joinWith([
                'category',
                'author'
            ])->all();

        return $this->render('index', [
            'models' => $publications
        ]);
    }
}
