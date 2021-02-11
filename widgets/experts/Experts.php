<?php

namespace app\widgets\experts;

use app\models\PredictionCounter;
use yii\bootstrap4\Widget;

class Experts extends Widget
{
    public function run()
    {
        $counters = PredictionCounter::find()->orderBy([
            'predictions' => SORT_DESC,
            'success_predictions' => SORT_DESC,
            'win_rate' => SORT_DESC,
        ])->andWhere(['<>', 'predictions', 0])->joinWith(['user'])->limit(10)->all();

        return $this->render('index', [
            'models' => $counters
        ]);
    }
}
