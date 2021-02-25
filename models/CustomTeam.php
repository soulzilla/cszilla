<?php

namespace app\models;

use app\components\core\ActiveRecord;
use Yii;

/**
 * This is the model class for table "custom_teams".
 *
 * @property int $id
 * @property string $name
 * @property int $user_id
 * @property int $format
 * @property string $invite_code
 * @property string|null $ts
 *
 * @property Profile[] $players
 */
class CustomTeam extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'custom_teams';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'user_id', 'invite_code', 'format'], 'required'],
            [['user_id'], 'default', 'value' => null],
            [['user_id', 'format'], 'integer'],
            [['ts'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['invite_code'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'user_id' => 'User ID',
            'invite_code' => 'Код приглашения',
            'ts' => 'Ts',
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert) {
            $player = new Player();
            $player->team_id = $this->id;
            $player->user_id = Yii::$app->user->id;
            $player->save();
        }

        parent::afterSave($insert, $changedAttributes);
    }

    public function getPlayers()
    {
        return $this->hasMany(Profile::class, ['user_id' => 'user_id'])
            ->viaTable(Player::tableName(), ['team_id' => 'id'])
            ->indexBy('user_id');
    }
}
