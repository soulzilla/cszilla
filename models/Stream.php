<?php

namespace app\models;

use app\components\core\ActiveRecord;
use app\enums\StreamSourcesEnum;

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
                $channelId = str_replace('/', '', $videoParams['query']);
                return 'https://player.twitch.tv/?'. $channelId . '&parent=cszilla.ru';
        }

        return '';
    }

    public function getChannelName()
    {
        $videoParams = parse_url($this->url);
        return str_replace('/', '', $videoParams['path']);
    }

    public function getDefaultUrl()
    {
        switch ($this->source) {
            case StreamSourcesEnum::SOURCE_TWITCH:
                $videoParams = parse_url($this->url);
                $channelId = str_replace('/', '', $videoParams['query']);
                $channelId = str_replace('channel=', '', $channelId);
                return 'https://www.twitch.tv/' . $channelId;
        }

        return $this->url;
    }
}
