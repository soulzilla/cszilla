<?php

namespace app\filters;

use app\components\core\ActiveQuery;
use app\components\core\Filter;

class CategoriesFilter extends Filter
{
    public $name;

    public function applyFilter(ActiveQuery $query, $params = [])
    {
        parent::applyFilter($query, $params);

        if ($this->name) {
            $query->andFilterWhere(['ilike', 'name', $this->name]);
        }
    }
}