<?php

namespace app\models;

use app\behaviors\NotificationBehavior;
use app\behaviors\SitemapBehavior;
use app\components\core\ActiveRecord;
use app\components\helpers\Url;
use app\traits\EntityRelationsTrait;
use app\traits\CounterTrait;

/**
 * This is the model class for table "promo_codes".
 *
 * @property int $id
 * @property int $entity_id
 * @property string $entity_table
 * @property string|null $description
 * @property string|null $amount
 * @property string|null $url
 * @property string $code
 * @property int $activations
 * @property string|null $ts
 * @property int $is_published
 */
class PromoCode extends ActiveRecord
{
    use EntityRelationsTrait, CounterTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'promo_codes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['entity_id', 'entity_table', 'code'], 'required'],
            [['entity_id', 'activations', 'is_published']],
            [['entity_id', 'activations', 'is_published'], 'integer'],
            [['description'], 'string'],
            [['entity_table', 'amount', 'url', 'code'], 'string', 'max' => 255],
            ['url', 'url']
        ];
    }

    public function behaviors()
    {
        return [
            'notification' => [
                'class' => NotificationBehavior::class
            ],
            'sitemap' => [
                'class' => SitemapBehavior::class,
                'url' => '/promos'
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
            'description' => 'Описание',
            'amount' => 'Сумма',
            'url' => 'Ссылка',
            'code' => 'Код',
            'activations' => 'Количество активаций',
            'ts' => 'Дата создания',
            'is_published' => 'Опубликовано',
        ];
    }

    public function getSitemapUrl(): string
    {
        return Url::to(['/main/promos/view', 'id' => $this->id]);
    }
}
