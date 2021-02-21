<?php

namespace app\models;

use app\components\core\ActiveRecord;

/**
 * This is the model class for table "teams".
 *
 * @property int $id
 * @property string $name
 * @property string $logo
 * @property string $hltv_profile
 * @property int $hltv_id
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
            [['name', 'logo', 'hltv_id'], 'required'],
            [['name', 'logo', 'hltv_profile'], 'string', 'max' => 255],
            ['hltv_id', 'integer']
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
