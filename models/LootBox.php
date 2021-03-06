<?php

namespace app\models;

use app\behaviors\RelatedNewsBehavior;
use app\behaviors\SitemapBehavior;
use app\components\core\ActiveRecord;
use app\components\helpers\StringHelper;
use app\components\helpers\Url;
use app\traits\BonusesTrait;
use app\traits\ComplaintsAndOverviewsTrait;
use app\traits\ObserversTrait;
use app\traits\ProsAndConsTrait;
use app\traits\RelatedPublicationsTrait;
use app\traits\SeoTrait;
use app\traits\CounterTrait;

/**
 * This is the model class for table "loot_boxes".
 *
 * @property int $id
 * @property string $name
 * @property string $name_canonical
 * @property string|null $logo
 * @property string $description
 * @property string|null $pros
 * @property string|null $cons
 * @property int|null $order
 * @property string|null $currencies
 * @property string|null $payment_methods
 * @property string $website
 * @property int $recommended
 * @property string|null $ts
 * @property int $is_published
 *
 * @property Box[] $boxes
 */
class LootBox extends ActiveRecord
{
    use SeoTrait, ProsAndConsTrait, BonusesTrait, CounterTrait, ComplaintsAndOverviewsTrait, ObserversTrait,
        RelatedPublicationsTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'loot_boxes';
    }

    public function jsonAttributes()
    {
        return [
            'currencies', 'payment_methods', 'cons', 'pros'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'website'], 'required'],
            [['name'], 'validateName'],
            [['logo', 'description'], 'string'],
            [['order', 'recommended', 'is_published'], 'integer'],
            [['pros', 'cons', 'currencies', 'payment_methods', 'attachments', 'related_publications'], 'safe'],
            [['name', 'name_canonical', 'website'], 'string', 'max' => 255],
            [['name_canonical'], 'unique'],
            [['order'], 'unique'],
        ];
    }

    public function behaviors()
    {
        return [
            'sitemap' => [
                'class' => SitemapBehavior::class
            ],
            'relatedNews' => [
                'class' => RelatedNewsBehavior::class
            ]
        ];
    }

    public function validateName()
    {
        if (!$this->name) {
            $this->addError('name', 'Заголовк не может быть пустым');
        }

        if (!$this->name_canonical) {
            $this->name_canonical = StringHelper::transliterate($this->name);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'name_canonical' => 'Canonical',
            'logo' => 'Логотип',
            'description' => 'Описание',
            'pros' => 'Плюсы',
            'cons' => 'Минусы',
            'order' => 'Место в списке',
            'currencies' => 'Валюта',
            'payment_methods' => 'Платежные методы',
            'website' => 'Официальный сайт',
            'recommended' => 'Рекомендован',
            'ts' => 'Время создания',
            'is_published' => 'Опубликован',
        ];
    }

    public function getBoxes()
    {
        return $this->hasMany(Box::class, ['site_id' => 'id'])->orderBy(['order' => SORT_ASC]);
    }

    public function getSitemapUrl(): string
    {
        return Url::to(['/main/loot-boxes/view', 'name_canonical' => $this->name_canonical]);
    }
}
