<?php

namespace app\models;

use app\components\core\ActiveRecord;

/**
 * This is the model class for table "custom_teams".
 *
 * @property int $id
 * @property string $name
 * @property int $user_id
 * @property string $invite_code
 * @property string|null $ts
 */
class CustomTeam extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'custom_teams';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'user_id', 'invite_code'], 'required'],
            [['user_id'], 'default', 'value' => null],
            [['user_id'], 'integer'],
            [['ts'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['invite_code'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'user_id' => 'User ID',
            'invite_code' => 'Invite Code',
            'ts' => 'Ts',
        ];
    }
}
