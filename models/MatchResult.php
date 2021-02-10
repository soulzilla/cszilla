<?php

namespace app\models;

use app\components\core\ActiveRecord;

/**
 * This is the model class for table "match_results".
 *
 * @property int $id
 * @property int $match_id
 * @property int $winner_team
 * @property int $state
 * @property string|null $ts
 */
class MatchResult extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'match_results';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['match_id', 'winner_team'], 'required'],
            [['match_id', 'winner_team', 'state'], 'default', 'value' => null],
            [['match_id', 'winner_team', 'state'], 'integer'],
            [['ts'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'match_id' => 'Match ID',
            'winner_team' => 'Winner Team',
            'state' => 'State',
            'ts' => 'Ts',
        ];
    }
}
