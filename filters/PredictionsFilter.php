<?php

namespace app\filters;

use app\components\core\ActiveQuery;
use app\components\core\Filter;

class PredictionsFilter extends Filter
{
    public $user_id;
    public $match_id;
    public $selected_team;

    public function applyFilter(ActiveQuery $query, $params = [])
    {
        parent::applyFilter($query, $params);

        if ($this->user_id) {
            $query->andWhere(['predictions.user_id' => $this->user_id]);
        }

        if ($this->match_id) {
            $query->andWhere(['match_id' => $this->match_id]);
        }

        if ($this->selected_team) {
            $query->andWhere(['selected_team' => $this->selected_team]);
        }
    }
}
