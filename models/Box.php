<?php

namespace app\models;

use app\components\core\ActiveRecord;
use Yii;

/**
 * This is the model class for table "boxes".
 *
 * @property int $id
 * @property int $site_id
 * @property string $name
 * @property string|null $url
 * @property int $show_url
 * @property int $cost
 * @property int $order
 * @property string|null $average_drop
 * @property string|null $ts
 */
class Box extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'boxes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['site_id', 'name'], 'required'],
            [['site_id', 'show_url', 'cost'], 'default', 'value' => null],
            [['site_id', 'show_url', 'cost', 'order'], 'integer'],
            [['ts'], 'safe'],
            [['name', 'url', 'average_drop'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'site_id' => 'Сайт',
            'name' => 'Название',
            'url' => 'Ссылка',
            'show_url' => 'Показывать ссылку',
            'cost' => 'Стоимость',
            'average_drop' => 'Средний дроп',
            'order' => 'Порядок',
            'ts' => 'Время создания',
        ];
    }

    public function getSite()
    {
        return $this->hasOne(LootBox::class, ['id' => 'site_id']);
    }
}
