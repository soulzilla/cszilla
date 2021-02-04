<?php

namespace app\traits;

use yii\web\NotFoundHttpException;

/**
 * Trait ReadOnlyActionsTrait
 * @package app\traits
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
