<?php

namespace app\widgets\search;

use Yii;
use yii\bootstrap4\Widget;

class Search extends Widget
{
    public function run()
    {
        $query = Yii::$app->request->get('query');
        return $this->render('index', [
            'query' => $query
        ]);
    }
}
