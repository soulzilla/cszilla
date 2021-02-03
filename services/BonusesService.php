<?php

namespace app\services;

use app\components\core\ActiveQuery;
use app\components\core\Service;
use app\models\Bonus;
use yii\web\NotFoundHttpException;

class BonusesService extends Service
{
    /**
     * @inheritDoc
     */
    public function getModel()
    {
        return new Bonus();
    }

    public function prepareQuery(ActiveQuery $query)
    {
        parent::prepareQuery($query);
        $query->with(['bookmaker', 'casino', 'lootBox']);
    }

    /**
     * @param $id
     * @return Bonus
     * @throws NotFoundHttpException
     */
    public function oneBonusWithRelations($id)
    {
        /** @var Bonus $model */
        $model = Bonus::find()->where(['bonuses.id' => $id, 'bonuses.is_published' => 1])->joinWith(['counter'])->one();

        if (!$model) {
            throw new NotFoundHttpException();
        }

        $model->addView();

        return $model;
    }
}
