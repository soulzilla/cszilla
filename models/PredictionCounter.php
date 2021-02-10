<?php

namespace app\models;

use app\components\core\ActiveRecord;

/**
 * This is the model class for table "prediction_counters".
 *
 * @property int $id
 * @property int $user_id
 * @property int $predictions
 * @property int $success_predictions
 * @property string $win_rate
 * @property string $update_ts
 *
 * @property Profile $user
 */
class PredictionCounter extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prediction_counters';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'update_ts'], 'required'],
            [['user_id', 'predictions', 'success_predictions'], 'integer'],
            [['win_rate', 'update_ts'], 'string', 'max' => 255],
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
            'predictions' => 'Predictions',
            'success_predictions' => 'Success Predictions',
            'win_rate' => 'Win Rate',
            'update_ts' => 'Update Ts',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(Profile::class, ['user_id' => 'user_id']);
    }
}
