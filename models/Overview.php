<?php

namespace app\models;

use app\components\core\ActiveRecord;
use Yii;
use yii\bootstrap4\Html;

/**
 * This is the model class for table "overviews".
 *
 * @property int $id
 * @property int $user_id
 * @property string $entity_table
 * @property int $entity_id
 * @property string $body
 * @property string|null $ts
 * @property int $is_deleted
 * @property int $is_blocked
 *
 * @property Profile $author
 */
class Overview extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'overviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entity_table', 'entity_id', 'user_id'], 'required'],
            ['body', 'required', 'message' => ''],
            [['is_deleted', 'is_blocked'], 'default', 'value' => 0],
            [['entity_id', 'is_deleted', 'is_blocked', 'user_id'], 'integer'],
            [['body'], 'string'],
            [['entity_table'], 'string', 'max' => 255],
            ['body', 'filter', 'filter' => function ($value) {
                return Html::encode($value);
            }]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity_table' => 'Таблица сущности',
            'entity_id' => 'Сущность',
            'body' => 'Текст',
            'ts' => 'Время создания',
            'is_deleted' => 'Удалён',
            'is_blocked' => 'Заблокирован',
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->updateEntityCounter();

        parent::afterSave($insert, $changedAttributes);
    }

    public function afterDelete()
    {
        $this->updateEntityCounter();

        parent::afterDelete();
    }

    private function updateEntityCounter()
    {
        $count = Overview::find()
            ->where([
                'entity_id' => $this->entity_id,
                'entity_table' => $this->entity_table,
                'is_deleted' => 0,
                'is_blocked' => 0
            ])->count();

        Counter::updateAll([
            'overviews' => $count
        ], [
            'entity_id' => $this->entity_id,
            'entity_table' => $this->entity_table
        ]);
    }

    public function getAuthor()
    {
        return $this->hasOne(Profile::class, ['user_id' => 'user_id']);
    }

    public function canDelete()
    {
        if (Yii::$app->user->isGuest) {
            return false;
        }

        if (Yii::$app->usersService->isGranted(['ROLE_SUPER_ADMIN'])) {
            return true;
        }

        return $this->user_id === Yii::$app->user->id;
    }
}
