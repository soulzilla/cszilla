<?php

namespace app\models;

use app\components\core\ActiveRecord;

/**
 * This is the model class for table "views".
 *
 * @property int $id
 * @property string $entity_table
 * @property int $entity_id
 * @property int $user_id
 * @property string $session_id
 * @property string|null $ts
 */
class View extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'views';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entity_table', 'entity_id', 'user_id', 'session_id'], 'required'],
            [['entity_id', 'user_id'], 'default', 'value' => null],
            [['entity_id', 'user_id'], 'integer'],
            [['ts'], 'safe'],
            [['entity_table', 'session_id'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity_table' => 'Entity Table',
            'entity_id' => 'Entity ID',
            'user_id' => 'User ID',
            'session_id' => 'Session ID',
            'ts' => 'Ts',
        ];
    }
}
