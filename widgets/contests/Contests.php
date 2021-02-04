<?php

namespace app\widgets\contests;

use app\models\Contest;
use yii\bootstrap4\Widget;

class Contests extends Widget
{
    public function run()
    {
        $model = Contest::find()->where([
            'is_published' => 1
        ])->orderBy(['id' => SORT_DESC])->one();

        return $this->render('index', [
            'model' => $model
        ]);
    }
}
