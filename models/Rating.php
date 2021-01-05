<?php

namespace app\models;

use app\components\core\ActiveRecord;

/**
 * This is the model class for table "ratings".
 *
 * @property int $id
 * @property int $user_id
 * @property string $entity_table
 * @property int $entity_id
 * @property int $rate
 */
class Rating extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ratings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'entity_table', 'entity_id', 'rate'], 'required'],
            [['user_id', 'entity_id', 'rate'], 'integer'],
            [['entity_table'], 'string', 'max' => 255],
        ];
    }
}
