<?php

namespace app\widgets\tickers;

use app\models\Ticker;
use yii\bootstrap4\Widget;
use yii\db\Expression;

class Tickers extends Widget
{
    public function run()
    {
        $tickers = Ticker::find()
            ->andWhere([
                '<', 'date_end', new Expression('NOW()')
            ])->all();

        return $this->render('index', [
            'models' => $tickers
        ]);
    }
}
