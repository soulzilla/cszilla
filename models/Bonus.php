<?php

namespace app\models;

use app\behaviors\NotificationBehavior;
use app\components\core\ActiveRecord;
use app\traits\EntityRelationsTrait;
use app\traits\CounterTrait;

/**
 * This is the model class for table "bonuses".
 *
 * @property int $id
 * @property int $entity_id
 * @property string $entity_table
 * @property int $amount
 * @property int $currency
 * @property string $description
 * @property string $rules
 * @property string|null $url
 * @property int $pinned
 * @property string|null $ts
 * @property int $is_published
 */
class Bonus extends ActiveRecord
{
    use EntityRelationsTrait, CounterTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bonuses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entity_id', 'entity_table', 'amount', 'currency', 'description', 'rules'], 'required'],
            [['entity_id', 'amount', 'currency', 'pinned', 'is_published'], 'default', 'value' => null],
            [['entity_id', 'amount', 'currency', 'pinned', 'is_published'], 'integer'],
            [['description', 'rules'], 'string'],
            [['entity_table', 'url'], 'string', 'max' => 255],
            ['url', 'url']
        ];
    }

    public function behaviors()
    {
        return [
            'notification' => [
                'class' => NotificationBehavior::class
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'entity_id' => 'Сущность привязки',
            'entity_table' => 'Тип сущности',
            'amount' => 'Сумма',
            'currency' => 'Валюта',
            'description' => 'Описание',
            'rules' => 'Правила',
            'url' => 'Ссылка',
            'pinned' => 'Закреплённый',
            'ts' => 'Дата создания',
            'is_published' => 'Опубликовано',
        ];
    }
}
