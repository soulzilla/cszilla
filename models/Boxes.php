<?php

namespace app\models;

use app\components\core\ActiveRecord;

/**
 * This is the model class for table "boxes".
 *
 * @property int $id
 * @property int $site_id
 * @property string|null $military_cost
 * @property string|null $military_average
 * @property string|null $restricted_cost
 * @property string|null $restricted_average
 * @property string|null $classified_cost
 * @property string|null $classified_average
 * @property string|null $covert_cost
 * @property string|null $covert_average
 * @property string|null $knife_cost
 * @property string|null $knife_average
 * @property string|null $gloves_cost
 * @property string|null $gloves_average
 * @property string|null $ak_cost
 * @property string|null $ak_average
 * @property string|null $awp_cost
 * @property string|null $awp_average
 * @property string|null $deagle_cost
 * @property string|null $deagle_average
 * @property string|null $glock_cost
 * @property string|null $glock_average
 * @property string|null $m4a1_cost
 * @property string|null $m4a1_average
 * @property string|null $usp_cost
 * @property string|null $usp_average
 * @property string|null $m4a4_cost
 * @property string|null $m4a4_average
 * @property string|null $top_cost
 * @property string|null $top_average
 */
class Boxes extends ActiveRecord
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
            [['site_id'], 'required'],
            [['site_id'], 'integer'],
            [[
                'military_cost',
                'military_average',
                'restricted_cost',
                'restricted_average',
                'classified_cost',
                'classified_average',
                'covert_cost',
                'covert_average',
                'knife_cost',
                'knife_average',
                'gloves_cost',
                'gloves_average',
                'ak_cost',
                'ak_average',
                'awp_cost',
                'awp_average',
                'deagle_cost',
                'deagle_average',
                'glock_cost',
                'glock_average',
                'm4a1_cost',
                'm4a1_average',
                'usp_cost',
                'usp_average',
                'm4a4_cost',
                'm4a4_average',
                'top_cost',
                'top_average'
            ], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'site_id' => 'Лутбокс',
            'military_cost' => 'Армейка Cost',
            'military_average' => 'Армейка Average',
            'restricted_cost' => 'Запрещенное Cost',
            'restricted_average' => 'Запрщенное Average',
            'classified_cost' => 'Засекреченное Cost',
            'classified_average' => 'Засекреченное Average',
            'covert_cost' => 'Тайное Cost',
            'covert_average' => 'Тайное Average',
            'knife_cost' => 'Ножевой Cost',
            'knife_average' => 'Ножевой Average',
            'gloves_cost' => 'Перчатки Cost',
            'gloves_average' => 'Перчатки Average',
            'ak_cost' => 'Ak Cost',
            'ak_average' => 'Ak Average',
            'awp_cost' => 'Awp Cost',
            'awp_average' => 'Awp Average',
            'deagle_cost' => 'Deagle Cost',
            'deagle_average' => 'Deagle Average',
            'glock_cost' => 'Glock Cost',
            'glock_average' => 'Glock Average',
            'm4a1_cost' => 'M4a1 Cost',
            'm4a1_average' => 'M4a1 Average',
            'usp_cost' => 'Usp Cost',
            'usp_average' => 'Usp Average',
            'm4a4_cost' => 'M4a4 Cost',
            'm4a4_average' => 'M4a4 Average',
            'top_cost' => 'Top Cost',
            'top_average' => 'Top Average',
        ];
    }

    public function beforeSave($insert)
    {
        foreach ($this->attributes as $attribute => $value) {
            if ($value === '') {
                $this->{$attribute} = '-';
            }
        }

        parent::beforeSave($insert);
    }
}
