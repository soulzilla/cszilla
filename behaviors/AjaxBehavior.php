<?php

namespace app\behaviors;

use app\components\core\Controller;
use Yii;
use yii\base\Behavior;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class AjaxBehavior extends Behavior
{
    public $actions = [];

    /** @var Controller */
    public $owner;

    public function events()
    {
        return [
            Controller::EVENT_BEFORE_ACTION => 'beforeAction'
        ];
    }

    /**
     * @throws NotFoundHttpException
     */
    public function beforeAction()
    {
        $isAjaxRequest = Yii::$app->request->isAjax;

        if (!sizeof($this->actions) && !$isAjaxRequest) {
            throw new NotFoundHttpException();
        }

        if (!sizeof($this->actions) && $isAjaxRequest) {
            Yii::$app->response->format = Response::FORMAT_JSON;
        }

        if (in_array($this->owner->action->id, $this->actions) && !$isAjaxRequest) {
            throw new NotFoundHttpException();
        }

        if (sizeof($this->actions) && in_array($this->owner->action->id, $this->actions)) {
            Yii::$app->response->format = Response::FORMAT_JSON;
        }
    }
}
