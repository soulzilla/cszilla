<?php

namespace app\components\core;

use app\components\helpers\StringHelper;

class ActiveQuery extends \yii\db\ActiveQuery
{
    /**
     * Поиск по soundex индексу
     * @param array $condition
     * @param bool $each
     * @return ActiveQuery
     */
    public function soundEx(array $condition, bool $each = false)
    {
        foreach ($condition as $attribute => $value) {
            $value = StringHelper::soundEx($value);
            $this->generateAttributeAndAddToQuery(
                $attribute,
                'soundex',
                $value,
                $each
            );
        }

        return $this;
    }

    /**
     * Поиск по metaphone индексу
     * @param array $condition
     * @param bool $each
     * @return ActiveQuery
     */
    public function phoneme(array $condition, bool $each = false)
    {
        foreach ($condition as $attribute => $value) {
            $value = StringHelper::phoneme($value);
            $this->generateAttributeAndAddToQuery(
                $attribute,
                'phoneme',
                $value,
                $each
            );
        }

        return $this;
    }

    /**
     * Поиск по триграммному индексу
     * @param array $condition
     * @param bool $each
     * @return ActiveQuery
     */
    public function trigram(array $condition, bool $each = false)
    {
        foreach ($condition as $attribute => $value) {
            $value = StringHelper::trigram($value);
            $this->generateAttributeAndAddToQuery(
                $attribute,
                'trigram',
                $value,
                $each
            );
        }

        return $this;
    }

    private function generateAttributeAndAddToQuery(string $attribute, string $suffix, string $value, bool $each)
    {
        $generatedAttribute = $attribute . '_' . $suffix;
        if ($each) {
            $explodedValues = explode(' ', $value);
            foreach ($explodedValues as $explodedValue) {
                $generatedValue = '%' . $explodedValue . '%';
                $this->andFilterWhere(['ilike', $generatedAttribute, $generatedValue]);
            }
        } else {
            $generatedValue = '%' . $value . '%';
            $this->andFilterWhere(['ilike', $generatedAttribute, $generatedValue]);
        }
    }

    /**
     * @return $this
     */
    public function notDeleted()
    {
        $this->andWhere(['is_deleted' => 0]);
        return $this;
    }

    /**
     * @return $this
     */
    public function notBlocked()
    {
        $this->andWhere(['is_blocked' => 0]);
        return $this;
    }

    /**
     * @return $this
     */
    public function published()
    {
        $this->andWhere(['is_published' => 1]);
        return $this;
    }
}
