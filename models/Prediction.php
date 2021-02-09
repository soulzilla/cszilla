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
}
