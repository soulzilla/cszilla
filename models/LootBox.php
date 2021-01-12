<?php

namespace app\models;

use app\components\core\ActiveRecord;
use app\components\helpers\StringHelper;
use app\traits\BonusesTrait;
use app\traits\ComplaintsAndOverviewsTrait;
use app\traits\ObserversTrait;
use app\traits\ProsAndConsTrait;
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
 * @property Boxes $boxes
 */
class LootBox extends ActiveRecord
{
    use SeoTrait, ProsAndConsTrait, BonusesTrait, CounterTrait, ComplaintsAndOverviewsTrait, ObserversTrait;

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
            [['pros', 'cons', 'currencies', 'payment_methods'], 'safe'],
            [['name', 'name_canonical', 'website'], 'string', 'max' => 255],
            [['name_canonical'], 'unique'],
            [['order'], 'unique'],
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
        return $this->hasOne(Boxes::class, ['site_id' => 'id']);
    }
}
