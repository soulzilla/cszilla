<?php

namespace app\forms\tournament;

use app\components\helpers\Url;
use app\enums\TournamentFormatEnum;
use app\models\CustomTeam;
use app\models\TournamentTeam;
use Yii;
use yii\base\Model;

class RegisterWingmanForm extends Model
{
    public $tournament_id;
    public $team_id;

    /** @var CustomTeam */
    public $team;
    public $teamSummary = [];
    public $inviteCode;

    public function getFormat()
    {
        return TournamentFormatEnum::FORMAT_2V2;
    }

    public function hasAccess()
    {
        if (Yii::$app->user->isGuest) {
            return false;
        }

        return !is_null($this->team) && empty($this->teamSummary) && $this->isCaptain();
    }

    public function checkTeam()
    {
        $summary = [];

        if ($this->team) {
            foreach ($this->team->players as $player) {
                if (!$player->steam_url) {
                    $summary[] = 'Игрок ' . $player->name . ' не заполнил ссылку на профиль Steam.';
                }
                if (!$player->faceit_url) {
                    $summary[] = 'Игрок ' . $player->name . ' не заполнил ссылку на профиль FACEIT.';
                }
            }
            if (sizeof($this->team->players) < 2) {
                $summary[] = 'Состав не укомплектован. Приглашайте игроков в Вашу команду.';
                $this->inviteCode = Url::to(['/main/tournaments/invite', 'code' => $this->team->invite_code], 'https');
            }

            $this->teamSummary = $summary;
        }
    }

    public function isCaptain()
    {
        return $this->team->user_id == Yii::$app->user->id;
    }

    /**
     * @return \app\models\Profile[]
     */
    public function getPlayers()
    {
        return $this->team->players;
    }

    public function save()
    {
        $model = new TournamentTeam();
        $model->team_id = $this->team_id;
        $model->tournament_id = $this->tournament_id;

        return $model->save();
    }
}
