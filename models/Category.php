<?php

namespace app\models;

use app\components\core\ActiveRecord;
use app\components\helpers\StringHelper;
use app\traits\ObserversTrait;

/**
 * This is the model class for table "categories".
 *
 * @property int $id
 * @property string $name
 * @property string $name_canonical
 * @property int $is_published
 * @property int $order
 * @property string $color
 * @property string|null $ts
 *
 * @property CategoryPublications $counter
 */
class Category extends ActiveRecord
{
    use ObserversTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'name_canonical'], 'required'],
            [['is_published', 'order'], 'integer'],
            [['name', 'name_canonical', 'color'], 'string', 'max' => 255],
            [['name_canonical'], 'unique'],
            [['name'], 'unique'],
            [['name'], 'validateName']
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
            'name' => 'Наименование',
            'name_canonical' => 'Canonical',
            'is_published' => 'Опубликован',
            'order' => 'Порядок',
            'color' => 'Цвет',
            'ts' => 'Дата создания',
        ];
    }

    public function getCounter()
    {
        return $this->hasOne(CategoryPublications::class, ['category_id' => 'id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        if ($insert) {
            $counter = new CategoryPublications();
            $counter->category_id = $this->id;
            $counter->count = 0;
            $counter->save();
        }
    }
}
