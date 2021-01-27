<?php

namespace app\widgets\alert;

use Yii;
use yii\bootstrap4\Widget;

class Alert extends Widget
{
    public function run()
    {
        $session = Yii::$app->session;
        $flashes = $session->getAllFlashes();

        return $this->render('index', [
            'flashes' => $flashes
        ]);
    }
}
