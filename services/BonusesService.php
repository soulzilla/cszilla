<?php

namespace app\services;

use app\components\core\ActiveQuery;
use app\components\core\Service;
use app\models\Bonus;

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

    public function oneBonusWithRelations($id)
    {
        return Bonus::find()->where(['bonuses.id' => $id, 'bonuses.is_published' => 1])->joinWith(['counter'])->one();
    }
}
