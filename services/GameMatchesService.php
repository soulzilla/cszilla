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

    public function getLastFive()
    {
        return GameMatch::find()
            ->andWhere([
                'is_finished' => 0
            ])->orderBy([
                'start_ts' => SORT_ASC
            ])->with([
                'firstTeam', 'secondTeam', 'prediction'
            ])->limit(5)
            ->all();
    }
}
