<?php

namespace app\widgets\banners;

use app\models\Banner;
use yii\bootstrap4\Widget;

class Banners extends Widget
{
    public function run()
    {
        $banners = Banner::find()
            ->andWhere([
                'is_published' => 1
            ])->orderBy([
                'order' => SORT_ASC
            ])->all();

        return $this->render('index', [
            'models' => $banners
        ]);
    }
}
