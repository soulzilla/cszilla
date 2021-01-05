<?php

namespace app\models;

use app\components\core\ActiveRecord;
use Yii;

/**
 * This is the model class for table "contest_participants".
 *
 * @property int $id
 * @property int $user_id
 * @property int $contest_id
 * @property int $is_winner
 *
 * @property Profile $user
 */
class ContestParticipant extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contest_participants';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'contest_id'], 'required'],
            [['is_winner'], 'default', 'value' => 0],
            [['user_id', 'contest_id', 'is_winner'], 'integer'],
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
            'contest_id' => 'Contest ID',
            'is_winner' => 'Is Winner',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(Profile::class, ['user_id' => 'user_id']);
    }
}
