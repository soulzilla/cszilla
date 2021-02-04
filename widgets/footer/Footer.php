<?php

namespace app\widgets\footer;

use app\components\core\Controller;
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

        $links = Yii::$app->staticBlocksService->getSocialLinks();
        return $this->render('index', [
            'links' => $links
        ]);
    }
}