<?php

namespace app\models;

use app\components\core\ActiveRecord;
use app\components\helpers\Url;
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
 * @property Bookmaker|Casino|LootBox|Publication|Contest $entity
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
            ['content', 'string', 'min' => 2],
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
        if (Yii::$app->user->isGuest) {
            return false;
        }

        if (Yii::$app->usersService->isGranted(['ROLE_SUPER_ADMIN'])) {
            return true;
        }

        return $this->user_id === Yii::$app->user->id;
    }

    public function getEntity()
    {
        switch ($this->entity_table) {
            case 'bookmakers':
                return $this->hasOne(Bookmaker::class, ['id' => 'entity_id']);
            case 'casinos':
                return $this->hasOne(Casino::class, ['id' => 'entity_id']);
            case 'loot_boxes':
                return $this->hasOne(LootBox::class, ['id' => 'entity_id']);
            case 'contests':
                return $this->hasOne(Contest::class, ['id' => 'entity_id']);
            case 'publications':
                return $this->hasOne(Publication::class, ['id' => 'entity_id']);
        }
    }

    public function getUrl()
    {
        switch ($this->entity_table) {
            case 'bookmakers':
                return Url::to(['/main/bookmakers/view', 'name_canonical' => $this->entity->name_canonical]);
            case 'casinos':
                return Url::to(['/main/casinos/view', 'name_canonical' => $this->entity->name_canonical]);
            case 'loot_boxes':
                return Url::to(['/main/loot-boxes/view', 'name_canonical' => $this->entity->name_canonical]);
            case 'contests':
                return Url::to(['/main/giveaways/view', 'id' => $this->entity->id]);
            case 'publications':
                return Url::to(['/main/news/view', 'title_canonical' => $this->entity->title_canonical]);
        }
    }
}
