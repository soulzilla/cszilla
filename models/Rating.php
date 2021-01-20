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
    public $count;
    public $average;

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

    public function afterSave($insert, $changedAttributes)
    {
        $count = Rating::find()->where([
            'entity_id' => $this->entity_id,
            'entity_table' => $this->entity_table
        ])->count();

        $average = (float) Rating::find()->where([
            'entity_id' => $this->entity_id,
            'entity_table' => $this->entity_table
        ])->average('rate');

        $average = round($average, 1);

        /** @var Counter $counter */
        $counter = Counter::find()->where([
            'entity_id' => $this->entity_id,
            'entity_table' => $this->entity_table
        ])->one();

        if (!$counter) {
            $counter = new Counter();
            $counter->entity_table = $this->entity_table;
            $counter->entity_id = $this->entity_id;
        }

        $counter->ratings = $count;
        $counter->average_rating = $average;
        $counter->save();
        $this->count = $count;
        $this->average = $average;

        parent::afterSave($insert, $changedAttributes);
    }
}
