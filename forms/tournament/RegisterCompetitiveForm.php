<?php

namespace app\forms\tournament;

use app\enums\TournamentFormatEnum;
use Yii;
use yii\base\Model;

class RegisterCompetitiveForm extends Model
{
    public $tournament_id;
    public $team_id;

    public $team;
    public $teamSummary;

    public function getFormat()
    {
        return TournamentFormatEnum::FORMAT_5V5;
    }

    public function hasAccess()
    {
        if (Yii::$app->user->isGuest) {
            return false;
        }

        return !is_null($this->team) && empty($this->teamSummary);
    }

    public function init()
    {
        parent::init();
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

            $this->teamSummary = $summary;
        }
    }
}
