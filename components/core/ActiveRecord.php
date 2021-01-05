<?php

namespace app\components\core;

use app\enums\YesOrNoEnum;
use yii\helpers\Json;

/**
 * Class ActiveRecord
 * @package app\components\core
 * @property int $id
 */
class ActiveRecord extends \yii\db\ActiveRecord
{
    public static function find()
    {
        return new ActiveQuery(static::class);
    }

    public function delete()
    {
        if (!$this->hasAttribute('is_deleted')) {
            return parent::delete();
        }

        $this->beforeDelete();
        $this->updateAll([
            'is_deleted' => YesOrNoEnum::STATE_YES
        ], [
            'id' => $this->id
        ]);

        return $this->afterDelete();
    }

    public function jsonAttributes()
    {
        return [];
    }

    public function afterFind()
    {
        parent::afterFind();
        $jsonAttributes = $this->jsonAttributes();
        if (sizeof($jsonAttributes)) {
            foreach ($jsonAttributes as $attribute) {
                $this->{$attribute} = Json::decode($this->{$attribute}, true);
            }
        }
    }
}
