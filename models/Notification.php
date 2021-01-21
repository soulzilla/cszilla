<?php

namespace app\models;

use app\components\core\ActiveRecord;
use app\components\helpers\Url;
use Yii;

/**
 * This is the model class for table "notifications".
 *
 * @property int $id
 * @property string $content
 * @property int $target_id
 * @property int $source_id
 * @property string $source_table
 * @property string $source_key
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
            [['content', 'target_id', 'source_id', 'source_table', 'source_key'], 'required'],
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

    public function getUrl()
    {
        if (!$this->source_key) {
            return '#';
        }

        switch ($this->source_table) {
            case 'categories':
                return Url::to(['/main/news/view', 'title_canonical' => $this->source_key]);
            default:
                return $this->source_key;
        }
    }
}
