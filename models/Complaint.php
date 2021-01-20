<?php

namespace app\models;

use app\components\core\ActiveRecord;
use Yii;
use yii\bootstrap4\Html;

/**
 * This is the model class for table "complaints".
 *
 * @property int $id
 * @property int $user_id
 * @property string $entity_table
 * @property int $entity_id
 * @property string $body
 * @property string|null $admin_answer
 * @property int $status
 * @property string|null $ts
 * @property int $is_deleted
 *
 * @property Profile $author
 */
class Complaint extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'complaints';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entity_table', 'entity_id', 'user_id'], 'required'],
            ['body', 'required', 'message' => ''],
            [['status', 'is_deleted'], 'default', 'value' => 0],
            [['entity_id', 'status', 'is_deleted', 'user_id'], 'integer'],
            [['body', 'admin_answer'], 'string'],
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
            'admin_answer' => 'Ответ администрации',
            'status' => 'Статус',
            'ts' => 'Дата создания',
            'is_deleted' => 'Удалён',
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
        $count = Complaint::find()
            ->where([
                'entity_id' => $this->entity_id,
                'entity_table' => $this->entity_table,
                'is_deleted' => 0
            ])->count();

        Counter::updateAll([
            'complaints' => $count
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
