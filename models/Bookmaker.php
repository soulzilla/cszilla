<?php

namespace app\models;

use app\behaviors\RelatedNewsBehavior;
use app\behaviors\SitemapBehavior;
use app\components\core\ActiveRecord;
use app\components\helpers\StringHelper;
use app\components\helpers\Url;
use app\traits\{BonusesTrait,
    ComplaintsAndOverviewsTrait,
    ObserversTrait,
    ProsAndConsTrait,
    RelatedPublicationsTrait,
    SeoTrait,
    CounterTrait};

/**
 * This is the model class for table "bookmakers".
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
 * @property string|null $android_app
 * @property string|null $ios_app
 * @property int $has_live_mode
 * @property string|null $margin
 * @property int $has_license
 * @property int $cupis
 * @property int $recommended
 * @property string|null $ts
 * @property int $is_published
 *
 * @property BetLine[] $lines
 */
class Bookmaker extends ActiveRecord
{
    use SeoTrait, ProsAndConsTrait, BonusesTrait, CounterTrait, ComplaintsAndOverviewsTrait, ObserversTrait,
        RelatedPublicationsTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bookmakers';
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
            [['order', 'has_live_mode', 'has_license', 'cupis', 'recommended', 'is_published'], 'default', 'value' => 0],
            [['order', 'has_live_mode', 'has_license', 'cupis', 'recommended', 'is_published'], 'integer'],
            [['name', 'name_canonical', 'website', 'android_app', 'ios_app', 'margin'], 'string', 'max' => 255],
            [['name_canonical'], 'unique'],
            [['order'], 'unique'],
            [['pros', 'cons', 'currencies', 'payment_methods', 'attachments', 'related_publications'], 'safe'],
        ];
    }

    public function behaviors()
    {
        return [
            'sitemap' => [
                'class' => SitemapBehavior::class,
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
            'payment_methods' => 'Методы оплаты',
            'website' => 'Веб-сайт',
            'android_app' => 'Приложение для андроид',
            'ios_app' => 'Приложение для ios',
            'has_live_mode' => 'Есть лайв режим',
            'margin' => 'Маржа',
            'has_license' => 'Есть лицензия',
            'cupis' => 'ЦУПИС',
            'recommended' => 'Рекомендуемый',
            'ts' => 'Время создания',
            'is_published' => 'Опубликован',
        ];
    }

    public function getLines()
    {
        return $this->hasMany(BetLine::class, ['bookmaker_id' => 'id'])->orderBy(['order' => SORT_ASC]);
    }

    public function getSitemapUrl(): string
    {
        return Url::to(['/main/bookmakers/view', 'name_canonical' => $this->name_canonical]);
    }
}
