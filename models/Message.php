<?php

namespace app\models;

use app\components\core\ActiveRecord;

/**
 * This is the model class for table "messages".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $email
 * @property string|null $additional_info
 * @property string $content
 * @property string|null $ts
 *
 * @property User $user
 */
class Message extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'content'], 'required', 'message' => ''],
            [['user_id'], 'integer'],
            [['content'], 'string'],
            ['email', 'required', 'when' => function ($model) {
                return empty($model->additional_info);
            }, 'message' => 'Заполните свой email или введите другие контакнтые данные в соседнем поле',
                'whenClient' => "function (attribute, value) {
                    return $('#message-additional_info').val().length == 0;
                }"
            ],
            ['ts', 'default', 'value' => date('Y-m-d H:i:s')],
            [['email', 'additional_info'], 'string', 'max' => 255]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Пользователь',
            'email' => 'Email',
            'additional_info' => 'Контактные данные',
            'content' => 'Содержимое',
            'ts' => 'Ts',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
