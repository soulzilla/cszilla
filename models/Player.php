<?php

namespace app\models;

use app\components\core\ActiveRecord;

/**
 * This is the model class for table "players".
 *
 * @property int $id
 * @property int $user_id
 * @property int $team_id
 */
class Player extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'players';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'team_id'], 'required'],
            [['user_id', 'team_id'], 'default', 'value' => null],
            [['user_id', 'team_id'], 'integer'],
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
            'team_id' => 'Team ID',
        ];
    }
}
