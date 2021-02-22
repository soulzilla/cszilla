<?php

namespace app\models;

use app\components\core\ActiveRecord;

/**
 * This is the model class for table "tournament_matches".
 *
 * @property int $id
 * @property int $tournament_id
 * @property int $first_team
 * @property int $second_team
 * @property int $stage
 * @property int|null $score_first
 * @property int|null $score_second
 */
class TournamentMatch extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tournament_matches';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tournament_id', 'first_team', 'second_team', 'stage'], 'required'],
            [['tournament_id', 'first_team', 'second_team', 'stage', 'score_first', 'score_second'], 'default', 'value' => null],
            [['tournament_id', 'first_team', 'second_team', 'stage', 'score_first', 'score_second'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tournament_id' => 'Турнир',
            'first_team' => 'Первый участник',
            'second_team' => 'Второй участник',
            'stage' => 'Этап',
            'score_first' => 'Очки первого участника',
            'score_second' => 'Очки второго участника',
        ];
    }
}
