<?php

namespace app\models;

use app\components\core\ActiveRecord;

/**
 * This is the model class for table "game_matches".
 *
 * @property int $id
 * @property int $first_team
 * @property int $second_team
 * @property int|null $winner_team
 * @property string $start_ts
 */
class GameMatch extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'game_matches';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_team', 'second_team', 'start_ts'], 'required'],
            [['first_team', 'second_team', 'winner_team'], 'default', 'value' => null],
            [['first_team', 'second_team', 'winner_team'], 'integer'],
            [['start_ts'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_team' => 'Первая команда',
            'second_team' => 'Вторая команда',
            'winner_team' => 'Победитель',
            'start_ts' => 'Время начала',
        ];
    }
}
