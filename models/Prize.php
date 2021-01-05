<?php

namespace app\models;

use app\components\core\ActiveRecord;

/**
 * This is the model class for table "prizes".
 *
 * @property int $id
 * @property int $contest_id
 * @property string $name
 * @property string|null $image
 * @property int $sent
 * @property int $order
 *
 * @property Contest $contest
 */
class Prize extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prizes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contest_id', 'name'], 'required'],
            [['sent'], 'default', 'value' => 0],
            [['contest_id', 'sent', 'order'], 'integer'],
            [['name', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'contest_id' => 'Конкурс',
            'name' => 'Название',
            'image' => 'Картинка',
            'sent' => 'Отправлено',
            'order' => 'Порядок'
        ];
    }

    public function getContest()
    {
        return $this->hasOne(Contest::class, ['id' => 'contest_id']);
    }
}
