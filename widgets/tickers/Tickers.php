<?php

namespace app\widgets\tickers;

use app\models\Ticker;
use yii\bootstrap4\Widget;

class Tickers extends Widget
{
    public function run()
    {
        $tickers = Ticker::find()
            ->andWhere(['<', 'date_start', date('Y-m-d H:i:s')])
            ->andWhere(['>', 'date_end', date('Y-m-d H:i:s')])
            ->cache(300)
            ->all();

        return $this->render('index', [
            'models' => $tickers
        ]);
    }
}
