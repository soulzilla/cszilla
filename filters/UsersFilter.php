<?php

namespace app\filters;

use app\components\core\ActiveQuery;
use app\components\core\Filter;

class UsersFilter extends Filter
{
    public $name;
    public $email;

    public function applyFilter(ActiveQuery $query, $params = [])
    {
        parent::applyFilter($query, $params);

        if ($this->name) {
            $query->andFilterWhere(['ilike', 'name', $this->name]);
        }

        if ($this->email) {
            $query->andFilterWhere(['ilike', 'email', $this->email]);
        }
    }
}
