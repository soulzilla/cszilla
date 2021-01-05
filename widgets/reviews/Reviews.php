<?php

namespace app\widgets\reviews;

use app\models\Review;
use Yii;
use yii\bootstrap4\Widget;

class Reviews extends Widget
{
    public function run()
    {
        $model = new Review();
        $model->author_id = Yii::$app->user->id;

        return $this->render('index', [
            'model' => $model
        ]);
    }
}
