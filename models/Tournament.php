<?php

namespace app\models;

use app\components\core\ActiveRecord;
use app\enums\TournamentFormatEnum;
use app\traits\CounterTrait;
use app\traits\SeoTrait;

/**
 * This is the model class for table "tournaments".
 *
 * @property int $id
 * @property int $format
 * @property string $regulations
 * @property string $twitch_stream
 * @property int $show_stream
 * @property int $competitors_limit
 * @property string $prize_pool
 * @property int $serial_number
 * @property string $date_start
 * @property string|null $ts
 * @property int $is_published
 * @property int $is_finished
 * @property int $winner
 *
 * @property CustomTeam|Profile $participants
 */
class Tournament extends ActiveRecord
{
    use CounterTrait, SeoTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tournaments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['format', 'regulations', 'twitch_stream', 'competitors_limit', 'prize_pool', 'serial_number', 'date_start'], 'required'],
            [['format', 'show_stream', 'competitors_limit', 'serial_number', 'is_published'], 'default', 'value' => null],
            [['format', 'show_stream', 'competitors_limit', 'serial_number', 'is_published', 'is_finished', 'winner'], 'integer'],
            [['regulations', 'prize_pool'], 'string'],
            [['date_start', 'ts'], 'safe'],
            [['twitch_stream'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'format' => 'Формат',
            'regulations' => 'Регламент',
            'twitch_stream' => 'Ссылка на стрим',
            'show_stream' => 'Показывать стрим',
            'competitors_limit' => 'Количество участников',
            'prize_pool' => 'Призовой фонд',
            'serial_number' => 'Порядковый номер',
            'date_start' => 'Дата начала',
            'ts' => 'Дата создания',
            'is_published' => 'Опубликовано',
        ];
    }

    public function getParticipants()
    {
        if ($this->format == TournamentFormatEnum::FORMAT_1V1) {
            return $this->hasMany(Profile::class, ['user_id' => 'team_id'])
                ->viaTable(TournamentTeam::tableName(), ['tournament_id' => 'id']);
        }

        return $this->hasMany(CustomTeam::class, ['id' => 'team_id'])
            ->viaTable(TournamentTeam::tableName(), ['tournament_id' => 'id']);
    }

    public function getChannelName()
    {
        $videoParams = parse_url($this->twitch_stream);
        return str_replace('/', '', $videoParams['path']);
    }
}
