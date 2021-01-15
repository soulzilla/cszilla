<?php

namespace app\models;

use app\components\core\ActiveRecord;
use Yii;
use yii\bootstrap4\Html;

/**
 * Class Comment
 * @package app\models
 *
 * @property int $id
 * @property int $user_id
 * @property int $entity_id
 * @property string $entity_table
 * @property string $content
 * @property string $ts
 * @property bool $is_deleted
 * @property bool $is_blocked
 *
 * @property Profile $author
 */
class Comment extends ActiveRecord
{
    public static function tableName()
    {
        return 'comments';
    }

    public function rules()
    {
        return [
            [['user_id', 'entity_id', 'entity_table'], 'required'],
            [['entity_table', 'content'], 'string'],
            ['content', 'required', 'message' => ''],
            [['user_id', 'entity_id'], 'integer'],
            ['content', 'filter', 'filter' => function ($value) {
                return Html::encode($value);
            }],
            ['ts', 'default', 'value' => date('Y-m-d H:i:s')]
        ];
    }

    public function getAuthor()
    {
        return $this->hasOne(Profile::class, ['user_id' => 'user_id']);
    }

    public function canDelete()
    {
        if (Yii::$app->usersService->isGranted(['ROLE_SUPER_ADMIN'])) {
            return true;
        }

        return $this->user_id === Yii::$app->user->id;
    }
}
