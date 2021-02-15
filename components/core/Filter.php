<?php

namespace app\components\core;

use yii\base\Model;

/**
 * Класс для фильтрации данных
 * Class Filter
 * @package app\components\core
 */
abstract class Filter extends Model
{
    public $id;

    public function applyFilter(ActiveQuery $query, $params = [])
    {
        if (!sizeof($params)) {
            return;
        }
        $this->assign($params);
        if ($this->id) {
            $query->andWhere(['id' => $this->id]);
        }
    }

    protected function assign(array $params)
    {
        if (!sizeof($params)) {
            return;
        }
        $params = $params[$this->formName()];
        foreach ($params as $attribute => $value) {
            if (!$value) {
                continue;
            }
            $this->{$attribute} = $value;
        }
    }
}
