<?php

namespace app\models;

use app\components\core\ActiveRecord;
use Yii;

/**
 * This is the model class for table "banners".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string|null $background_image
 * @property int $order
 * @property int $is_published
 * @property string $url
 * @property string|null $ts
 */
class Banner extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banners';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content', 'url'], 'required'],
            [['content', 'background_image', 'url'], 'string'],
            [['order', 'is_published'], 'integer'],
            [['ts'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Заголовок',
            'content' => 'Содержимое',
            'background_image' => 'Фон',
            'order' => 'Порядок',
            'is_published' => 'Опубликован',
            'ts' => 'Время создания',
        ];
    }
}
