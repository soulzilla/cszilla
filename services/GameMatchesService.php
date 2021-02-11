<?php

namespace app\services;

use app\components\core\ActiveQuery;
use app\components\core\Service;
use app\models\GameMatch;

class GameMatchesService extends Service
{
    public function getModel()
    {
        return new GameMatch();
    }

    public function prepareQuery(ActiveQuery $query)
    {
        parent::prepareQuery($query);
        $query->with(['firstTeam', 'secondTeam'])->orderBy(['id' => SORT_DESC]);
    }
}
