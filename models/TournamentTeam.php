<?php

namespace app\models;

use app\components\core\ActiveRecord;

/**
 * This is the model class for table "tournament_teams".
 *
 * @property int $id
 * @property int $tournament_id
 * @property int $team_id
 *
 * @property Profile $profile
 * @property CustomTeam $team
 */
class TournamentTeam extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tournament_teams';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tournament_id', 'team_id'], 'required'],
            [['tournament_id', 'team_id'], 'default', 'value' => null],
            [['tournament_id', 'team_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tournament_id' => 'Tournament ID',
            'team_id' => 'Team ID',
        ];
    }

    public function getProfile()
    {
        return $this->hasOne(Profile::class, ['user_id' => 'team_id']);
    }

    public function getTeam()
    {
        return $this->hasOne(CustomTeam::class, ['id' => 'team_id']);
    }
}
