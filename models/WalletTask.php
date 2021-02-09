<?php

namespace app\models;

use app\components\core\ActiveRecord;

/**
 * This is the model class for table "wallet_tasks".
 *
 * @property int $id
 * @property string $content
 * @property string $url
 * @property int $cost
 */
class WalletTask extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wallet_tasks';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content', 'url', 'cost'], 'required'],
            [['cost'], 'default', 'value' => null],
            [['cost'], 'integer'],
            [['content', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Текст задания',
            'url' => 'Ссылка',
            'cost' => 'Стоимость',
        ];
    }
}
