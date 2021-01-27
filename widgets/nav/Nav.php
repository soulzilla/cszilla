<?php

namespace app\widgets\nav;

use app\components\core\Controller;
use app\models\Notification;
use Yii;
use yii\bootstrap4\Widget;

class Nav extends Widget
{
    /** @var Controller */
    public $currentController;

    public function run()
    {
        if ($this->currentController->action->id == 'error') {
            return '';
        }

        $socialLinks = Yii::$app->staticBlocksService->getSocialLinks();

        $categories = Yii::$app->categoriesService->getModel()::find()
            ->where(['categories.is_published' => 1])
            ->joinWith(['counter'])
            ->orderBy(['categories.order' => SORT_ASC])
            ->cache(300)
            ->all();

        return $this->render('index', [
            'currentController' => $this->currentController,
            'socialLinks' => $socialLinks,
            'categories' => $categories,
        ]);
    }
}
