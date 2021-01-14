<?php

namespace app\models;

use app\components\core\ActiveRecord;
use Yii;

/**
 * This is the model class for table "notifications".
 *
 * @property int $id
 * @property string $content
 * @property int $target_id
 * @property int $source_id
 * @property string $source_table
 * @property string $ts
 *
 * @property NotificationStatus $status
 */
class Notification extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notifications';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content', 'target_id', 'source_id', 'source_table'], 'required'],
            [['content', 'source_table'], 'string'],
            [['target_id', 'source_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'target_id' => 'Target ID',
        ];
    }

    public function getStatus()
    {
        return $this->hasOne(NotificationStatus::class, ['notification_id' => 'id'])->onCondition(['notification_statuses.user_id' => Yii::$app->user->id]);
    }

    public function createStatus()
    {
        $status = new NotificationStatus();
        $status->notification_id = $this->id;
        $status->user_id = Yii::$app->user->id;
        $status->save();
    }
}
