<?php

namespace app\models;

use app\components\core\ActiveRecord;

/**
 * This is the model class for table "teams".
 *
 * @property int $id
 * @property string $name
 * @property string $logo
 */
class Team extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'teams';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'logo'], 'required'],
            [['name', 'logo'], 'string', 'max' => 255],
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
            'logo' => 'Логотип',
        ];
    }
}
