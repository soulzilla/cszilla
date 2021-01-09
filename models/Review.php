<?php

namespace app\models;

use app\components\core\ActiveRecord;
use yii\bootstrap4\Html;

/**
 * This is the model class for table "reviews".
 *
 * @property int $id
 * @property string $content
 * @property int $author_id
 * @property int $order
 * @property string|null $ts
 * @property int $is_published
 *
 * @property Profile $author
 */
class Review extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'reviews';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'required', 'message' => 'Заполните отзыв'],
            [['author_id'], 'required'],
            [['content'], 'string', 'min' => 30],
            [['author_id', 'order', 'is_published'], 'integer'],
            ['content', 'filter', 'filter' => function ($value) {
                return Html::encode($value);
            }]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Содержимое',
            'author_id' => 'Автор',
            'order' => 'Порядок',
            'ts' => 'Время создания',
            'is_published' => 'Опубликован',
        ];
    }

    public function getAuthor()
    {
        return $this->hasOne(Profile::class, ['user_id' => 'author_id']);
    }
}
