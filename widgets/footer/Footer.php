<?php

namespace app\widgets\footer;

use app\components\core\Controller;
use app\models\Message;
use app\models\Page;
use Yii;
use yii\bootstrap4\Widget;

class Footer extends Widget
{
    /** @var Controller */
    public $currentController;

    public function run()
    {
        if ($this->currentController->action->id == 'error') {
            return '';
        }

        $model = new Message();

        $pages = Page::find()
            ->where(['is_published' => 1])
            ->orderBy(['order' => SORT_ASC])
            ->cache(300)
            ->all();

        $links = Yii::$app->staticBlocksService->getSocialLinks();
        return $this->render('index', [
            'links' => $links,
            'model' => $model,
            'pages' => $pages
        ]);
    }
}