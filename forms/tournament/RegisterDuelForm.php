<?php

namespace app\forms\tournament;

use app\models\TournamentTeam;
use Yii;
use yii\base\Model;

class RegisterDuelForm extends Model
{
    public $tournament_id;
    public $user_id;
    public $steam_url;
    public $faceit_url;

    public function loadData()
    {
        $this->steam_url = Yii::$app->user->identity->profile->steam_url;
        $this->faceit_url = Yii::$app->user->identity->profile->faceit_url;
    }

    public function rules()
    {
        return [
            [$this->attributes(), 'required']
        ];
    }

    /**
     * @return bool
     */
    public function save()
    {
        $model = new TournamentTeam();
        $model->tournament_id = $this->tournament_id;
        $model->team_id = $this->user_id;

        $profile = Yii::$app->user->identity->profile;
        $profile->steam_url = $this->steam_url;
        $profile->faceit_url = $this->faceit_url;

        return $model->save() && $profile->save();
    }
}
