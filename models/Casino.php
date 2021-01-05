<?php

namespace app\models;

use app\components\core\ActiveRecord;
use app\components\helpers\StringHelper;
use app\components\traits\{BonusesTrait,
    ComplaintsAndOverviewsTrait,
    ProsAndConsTrait,
    SeoTrait,
    ViewsLikesRatingsTrait};
use yii\helpers\Json;

/**
 * This is the model class for table "casinos".
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
 */
class Casino extends ActiveRecord
{
    use SeoTrait, ProsAndConsTrait, BonusesTrait, ViewsLikesRatingsTrait, ComplaintsAndOverviewsTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'casinos';
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
            [['name', 'name_canonical', 'website'], 'string', 'max' => 255],
            [['name_canonical'], 'unique'],
            [['order'], 'unique'],
            [['pros', 'cons', 'currencies', 'payment_methods'], 'safe'],
            [['pros', 'cons', 'currencies', 'payment_methods'], 'filter', 'filter' => function ($value) {
                return Json::encode($value);
            }],
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

    public function jsonAttributes()
    {
        return [
            'currencies', 'payment_methods', 'cons', 'pros'
        ];
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
}
