<?php

namespace app\components\core;

use yii\base\Component;
use yii\data\ActiveDataProvider;

abstract class Service extends Component
{
    public function getFilter(){}

    /**
     * Возвращает экземпляр класса сущности.
     * @return ActiveRecord
     */
    abstract public function getModel();

    public function findOne($id)
    {
        return $this->getModel()::findOne($id);
    }

    public function getDataProvider(ActiveQuery $query)
    {
        $this->prepareQuery($query);
        return new ActiveDataProvider([
            'query' => $query
        ]);
    }

    public function getTotalCount(ActiveQuery $query = null)
    {
        if (!$query) {
            $query = $this->getModel()::find();
        }

        return $query->count();
    }

    public function prepareQuery(ActiveQuery $query){}
}
