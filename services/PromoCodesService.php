<?php

namespace app\services;

use app\components\core\ActiveQuery;
use app\components\core\Service;
use app\models\PromoCode;
use yii\web\NotFoundHttpException;

class PromoCodesService extends Service
{
    public function getModel()
    {
        return new PromoCode();
    }

    public function prepareQuery(ActiveQuery $query)
    {
        $query->with(['bookmaker', 'casino', 'lootBox']);
    }

    /**
     * @param $id
     * @return PromoCode
     * @throws NotFoundHttpException
     */
    public function findOneWithRelations($id)
    {
        /** @var PromoCode $model */
        $model = PromoCode::find()->where(['promo_codes.id' => $id, 'promo_codes.is_published' => 1])->joinWith(['counter'])->one();

        if (!$model) {
            throw new NotFoundHttpException();
        }

        $model->addView();

        return $model;
    }
}
