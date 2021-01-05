<?php

namespace app\models;

use app\components\core\ActiveRecord;

/**
 * Class Counter
 * @package app\models
 * @property int $id
 * @property int $entity_id
 * @property string $entity_table
 * @property int $views
 * @property int $likes
 * @property int $complaints
 * @property int $reviews
 */
class Counter extends ActiveRecord
{
    public static function tableName()
    {
        return 'counters';
    }

    public function rules()
    {
        return [
            [['entity_id', 'entity_table'], 'required']
        ];
    }
}