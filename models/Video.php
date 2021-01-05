<?php

namespace app\models;

use app\components\core\ActiveRecord;
use app\enums\StreamSourcesEnum;
use Yii;

/**
 * This is the model class for table "videos".
 *
 * @property int $id
 * @property string $description
 * @property string $url
 * @property int $source
 * @property int $is_published
 * @property string|null $ts
 */
class Video extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'videos';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'url', 'source'], 'required'],
            [['description'], 'string'],
            [['source', 'is_published'], 'integer'],
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
            'source' => 'Ресурс',
            'is_published' => 'Опубликовано',
            'ts' => 'Ts',
        ];
    }

    public function getEmbedUrl()
    {
        switch ($this->source) {
            case StreamSourcesEnum::SOURCE_TWITCH:
                $videoParams = parse_url($this->url);
                $channelId = str_replace('/', '', $videoParams['path']);
                return 'https://player.twitch.tv/?' . $channelId . '&parent=' . Yii::$app->params['domain'];
            case StreamSourcesEnum::SOURCE_YOUTUBE:
                parse_str(parse_url($this->url, PHP_URL_QUERY), $videoParams);
                return '//www.youtube.com/embed/' . $videoParams['v'];
            default:
                return $this->url;
        }
    }
}
