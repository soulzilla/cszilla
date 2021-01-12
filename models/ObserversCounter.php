<?php

namespace app\models;

use app\components\core\ActiveRecord;
use Yii;

/**
 * This is the model class for table "observers_counters".
 *
 * @property int $id
 * @property int $count
 * @property int $entity_id
 * @property string $entity_table
 */
class ObserversCounter extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'observers_counters';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['count', 'entity_id'], 'integer'],
            [['entity_id', 'entity_table'], 'required'],
            [['entity_table'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'count' => 'Count',
            'entity_id' => 'Entity ID',
            'entity_table' => 'Entity Table',
        ];
    }
}
