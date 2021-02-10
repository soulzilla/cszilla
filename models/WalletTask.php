<?php

namespace app\models;

use app\components\core\ActiveRecord;
use Yii;

/**
 * This is the model class for table "wallet_tasks".
 *
 * @property int $id
 * @property string $content
 * @property string $url
 * @property int $cost
 *
 * @property TaskStatus $status
 */
class WalletTask extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wallet_tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content', 'url', 'cost'], 'required'],
            [['cost'], 'default', 'value' => null],
            [['cost'], 'integer'],
            [['content', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Текст задания',
            'url' => 'Ссылка',
            'cost' => 'Стоимость',
        ];
    }

    public function getStatus()
    {
        return $this->hasOne(TaskStatus::class, ['task_id' => 'id'])->onCondition(['task_statuses.user_id' => Yii::$app->user->id]);
    }
}
