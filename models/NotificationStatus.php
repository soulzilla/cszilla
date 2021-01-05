<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "notification_statuses".
 *
 * @property int $id
 * @property int $notification_id
 * @property int $user_id
 */
class NotificationStatus extends \app\components\core\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notification_statuses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['notification_id', 'user_id'], 'required'],
            [['notification_id', 'user_id'], 'default', 'value' => null],
            [['notification_id', 'user_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'notification_id' => 'Notification ID',
            'user_id' => 'User ID',
        ];
    }
}
