<?php

namespace app\models;

use app\components\core\ActiveRecord;

/**
 * This is the model class for table "seo".
 *
 * @property int $id
 * @property int $entity_id
 * @property string $entity_table
 * @property string|null $description
 * @property string|null $title
 * @property string|null $keywords
 * @property int|null $noindex
 */
class Seo extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entity_id', 'entity_table'], 'required'],
            [['entity_id', 'noindex'], 'default', 'value' => null],
            [['entity_id', 'noindex'], 'integer'],
            [['description'], 'string'],
            [['entity_table', 'title', 'keywords'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity_id' => 'ID сущности',
            'entity_table' => 'Таблица сущности',
            'description' => 'Описание',
            'title' => 'Заголовок',
            'keywords' => 'Ключевые слова',
            'noindex' => 'Не индексировать',
        ];
    }
}
