<?php

namespace app\models;

use app\components\core\ActiveRecord;
use Yii;

/**
 * This is the model class for table "tickers".
 *
 * @property int $id
 * @property string|null $content
 * @property string $date_start
 * @property string $date_end
 * @property string|null $ts
 */
class Ticker extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tickers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['date_start', 'date_end'], 'safe'],
            [['date_end'], 'required'],
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
            'date_start' => 'Дата начала',
            'date_end' => 'Дата конца',
            'ts' => 'Дата создания',
        ];
    }
}
