<?php

namespace app\widgets\hot;

use app\models\Publication;
use yii\bootstrap4\Widget;

class Related extends Widget
{
    /* @var Publication */
    public $currentPublication;

    public function run()
    {
        $models = Publication::find()
            ->where([
                'publications.category_id' => $this->currentPublication->category_id,
                'publications.is_published' => 1,
                'publications.is_deleted' => 0,
                'publications.is_blocked' => 0,
            ])->andWhere([
                '<', 'publications.publish_date', date('Y-m-d H:i:s')
            ])
            ->andWhere([
                '<>', 'publications.id', $this->currentPublication->id
            ])
            ->joinWith(['author'])
            ->limit(5)
            ->all();

        return $this->render('related', [
            'models' => $models
        ]);
    }
}