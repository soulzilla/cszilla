<?php

namespace app\traits;

use app\components\core\Service;
use yii\web\NotFoundHttpException;

/**
 * Trait ReadOnlyActionsTrait
 * @package app\traits
 *
 * @property Service $service
 */
trait ReadOnlyActionsTrait
{
    /**
     * @throws NotFoundHttpException
     */
    public function actionCreate()
    {
        throw new NotFoundHttpException();
    }

    /**
     * @param null $id
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id = null)
    {
        throw new NotFoundHttpException();
    }
}
