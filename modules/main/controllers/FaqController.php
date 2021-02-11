<?php

namespace app\modules\main\controllers;

use app\components\core\Controller;
use app\enums\FaqCategoriesEnum;
use app\models\Faq;
use Yii;

class FaqController extends Controller
{
    public function actionIndex()
    {
        $tab = Yii::$app->request->get('tab', FaqCategoriesEnum::CATEGORY_GENERAL);

        $models = Faq::find()
            ->where(['category' => $tab])
            ->cache(300)
            ->orderBy(['order' => SORT_ASC])
            ->all();

        return $this->render('index', [
            'models' => $models,
            'tab' => $tab
        ]);
    }
}
