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
            parent::delete();
            return;
        }

        $this->beforeDelete();
        $this->updateAll([
            'is_deleted' => YesOrNoEnum::STATE_YES
        ], [
            'id' => $this->id
        ]);

        $this->afterDelete();
    }

    public function jsonAttributes()
    {
        return [];
    }

    public function beforeValidate()
    {
        if ($this->hasAttribute('ts')) {
            if ($this->isNewRecord) {
                $this->setAttribute('ts', date('Y-m-d H:i:s'));
            }
        }
        return parent::beforeValidate();
    }

    public function beforeSave($insert)
    {
        $jsonAttributes = $this->jsonAttributes();
        if (sizeof($jsonAttributes)) {
            foreach ($jsonAttributes as $attribute) {
                if (!is_array($this->{$attribute})) {
                    continue;
                }
                $this->{$attribute} = Json::encode($this->{$attribute}, JSON_UNESCAPED_SLASHES);
            }
        }

        return parent::beforeSave($insert);
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
