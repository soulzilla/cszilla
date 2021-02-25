<?php

namespace app\forms;

use app\models\Player;
use Yii;
use yii\base\Model;

class AcceptInviteForm extends Model
{
    public $steam_url;
    public $faceit_url;
    public $team_id;

    public function rules()
    {
        return [
            [['steam_url', 'team_id', 'faceit_url'], 'required']
        ];
    }

    public function attributeLabels()
    {
        return [
            'steam_url' => 'Ссылка на профиль Steam',
            'faceit_url' => 'Ссылка на профиль FACEIT',
        ];
    }

    public function loadData()
    {
        $this->steam_url = Yii::$app->user->identity->profile->steam_url;
        $this->faceit_url = Yii::$app->user->identity->profile->faceit_url;
    }

    public function save()
    {
        $profile = Yii::$app->user->identity->profile;
        $profile->steam_url = $this->steam_url;
        $profile->faceit_url = $this->faceit_url;

        $player = new Player();
        $player->team_id = $this->team_id;
        $player->user_id = Yii::$app->user->id;

        return $player->save() && $profile->save();
    }
}
