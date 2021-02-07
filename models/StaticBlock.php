<?php

namespace app\models;

use app\components\core\ActiveRecord;
use app\enums\StaticBlockEnum;

/**
 * This is the model class for table "static_blocks".
 *
 * @property int $id
 * @property int $type
 * @property int|null $entity_id
 * @property string|null $entity_table
 * @property string|null $content
 * @property string|null $ts
 */
class StaticBlock extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'static_blocks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type', 'entity_id'], 'integer'],
            [['content'], 'string'],
            [['entity_table'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Тип',
            'entity_id' => 'Сущность',
            'entity_table' => 'Таблица сущности',
            'content' => 'Контент',
            'ts' => 'Время создания',
        ];
    }

    public function getIcon()
    {
        switch ($this->type) {
            case StaticBlockEnum::SOCIAL_VK:
                return 'vk';
            case StaticBlockEnum::SOCIAL_TELEGRAM:
                return 'telegram';
            case StaticBlockEnum::SOCIAL_YOUTUBE:
                return 'youtube';
            case StaticBlockEnum::SOCIAL_INSTAGRAM:
                return 'instagram';
            case StaticBlockEnum::SOCIAL_TWITCH:
                return 'twitch';
        }

        return '';
    }
}
