<?php

namespace app\models;

use app\components\core\ActiveRecord;
use app\components\helpers\Url;
use app\enums\StreamSourcesEnum;
use Yii;

/**
 * This is the model class for table "streams".
 *
 * @property int $id
 * @property string $description
 * @property string $url
 * @property int $source
 * @property int $is_finished
 * @property string|null $ts
 */
class Stream extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'streams';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'url', 'source'], 'required'],
            [['description'], 'string'],
            [['source', 'is_finished'], 'integer'],
            [['url'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Описание',
            'url' => 'Ссылка',
            'source' => 'Площадка',
            'is_finished' => 'Завершён',
            'ts' => 'Ts',
        ];
    }

    public function getEmbedUrl()
    {
        switch ($this->source) {
            case StreamSourcesEnum::SOURCE_TWITCH:
                $videoParams = parse_url($this->url);
                $channelId = str_replace('/', '', $videoParams['path']);
                return 'https://player.twitch.tv/?' . $channelId . '&parent=cszilla.ru';
        }
    }
}
