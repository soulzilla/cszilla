<?php

namespace app\models;

use app\components\core\ActiveRecord;

/**
 * This is the model class for table "wallets".
 *
 * @property int $id
 * @property int $user_id
 * @property int $coins
 */
class Wallet extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wallets';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'coins'], 'required'],
            [['user_id', 'coins'], 'default', 'value' => null],
            [['user_id', 'coins'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'coins' => 'Coins',
        ];
    }
}
