<?php

namespace app\models;

use app\components\core\ActiveRecord;

/**
 * This is the model class for table "tickers".
 *
 * @property int $id
 * @property string|null $content
 * @property string|null $url
 * @property int $target
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
            [['content', 'url'], 'string'],
            [['date_start', 'date_end'], 'safe'],
            [['date_end'], 'required'],
            [['target'], 'integer']
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
            'url' => 'Ссылка',
            'target' => 'Открывать ссылку в новом окне'
        ];
    }
}
