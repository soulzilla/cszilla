<?php

namespace app\models;

use app\components\core\ActiveRecord;
use Yii;

/**
 * This is the model class for table "observers".
 *
 * @property int $id
 * @property int $user_id
 * @property int $entity_id
 * @property string $entity_table
 */
class Observer extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'observers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'entity_id', 'entity_table'], 'required'],
            [['user_id', 'entity_id'], 'integer'],
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
            'user_id' => 'User ID',
            'entity_id' => 'Entity ID',
            'entity_table' => 'Entity Table',
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->updateObserversCounters();
        parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        $this->updateObserversCounters();
        parent::afterDelete();
    }

    private function updateObserversCounters()
    {
        $count = Observer::find()->where([
            'entity_id' => $this->entity_id,
            'entity_table' => $this->entity_table
        ])->count();

        $counter = ObserversCounter::find()->where([
            'entity_id' => $this->entity_id,
            'entity_table' => $this->entity_table
        ])->one();

        if (!$counter) {
            $counter = new ObserversCounter();
            $counter->entity_id = $this->entity_id;
            $counter->entity_table = $this->entity_table;
        }

        $counter->count = $count;
        $counter->save();
    }
}
