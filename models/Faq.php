<?php

namespace app\models;

use app\components\core\ActiveRecord;

/**
 * This is the model class for table "faq".
 *
 * @property int $id
 * @property int $category
 * @property int $order
 * @property string $question
 * @property string|null $answer
 * @property string|null $ts
 */
class Faq extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'faq';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category', 'order', 'question'], 'required'],
            [['category', 'order'], 'default', 'value' => null],
            [['category', 'order'], 'integer'],
            [['answer'], 'string'],
            [['ts'], 'safe'],
            [['question'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category' => 'Категория',
            'order' => 'Порядок',
            'question' => 'Вопрос',
            'answer' => 'Ответ',
            'ts' => 'Ts',
        ];
    }
}
