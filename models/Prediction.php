<?php

namespace app\models;

use app\components\core\ActiveRecord;

/**
 * This is the model class for table "predictions".
 *
 * @property int $id
 * @property int $user_id
 * @property int $match_id
 * @property int $selected_team
 * @property int $is_winner
 */
class Prediction extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'predictions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'match_id', 'selected_team', 'is_winner'], 'required'],
            [['user_id', 'match_id', 'selected_team', 'is_winner'], 'default', 'value' => null],
            [['user_id', 'match_id', 'selected_team', 'is_winner'], 'integer'],
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
            'match_id' => 'Match ID',
            'selected_team' => 'Selected Team',
            'is_winner' => 'Is Winner',
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        if (!$insert && $this->is_winner) {
            /** @var PredictionCounter $counter */
            $counter = PredictionCounter::find()->where(['user_id' => $this->user_id])->one();
            $current = $counter->success_predictions;
            $current += 1;
            $counter->success_predictions = $current;
            $win_rate = (int) (($counter->success_predictions / $counter->predictions) * 100);
            $counter->win_rate = (string) $win_rate;
            $counter->save();
        }

        parent::afterSave($insert, $changedAttributes);
    }
}
