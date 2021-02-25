<?php

namespace app\forms;

use app\enums\TournamentFormatEnum;
use app\forms\tournament\RegisterCompetitiveForm;
use app\forms\tournament\RegisterDuelForm;
use app\forms\tournament\RegisterWingmanForm;
use app\models\CustomTeam;
use app\models\Player;
use app\models\Tournament;
use app\models\TournamentTeam;
use Yii;
use yii\base\Model;

class TournamentBracketForm extends Model
{
    private $tournament;
    private $participants;
    private $isUserRegistered = false;

    public function __construct(Tournament $tournament, $config = [])
    {
        parent::__construct($config);
        $this->tournament = $tournament;
        if ($tournament->format == TournamentFormatEnum::FORMAT_1V1) {
            $this->participants = TournamentTeam::find()
                ->where(['tournament_id' => $this->tournament->id])
                ->indexBy('team_id')
                ->with(['profile'])
                ->all();
            if (Yii::$app->user->isGuest === false) {
                $this->isUserRegistered = isset($this->participants[Yii::$app->user->id]);
            }
        } else {
            $this->participants = TournamentTeam::find()
                ->where(['tournament_id' => $this->tournament->id])
                ->with(['team' => function ($query) {
                    $query->with(['players']);
                }])
                ->all();

            /** @var TournamentTeam $participant */
            foreach ($this->participants as $participant) {
                if (Yii::$app->user->isGuest) {
                    break;
                }
                $this->isUserRegistered = isset($participant->team->players[Yii::$app->user->id]);
                if (!$this->isUserRegistered) {
                    continue;
                }
                break;
            }
        }
    }

    public function getFormat()
    {
        return $this->tournament->format;
    }

    public function canRegister()
    {
        if (Yii::$app->user->isGuest) {
            return false;
        }

        if (sizeof($this->participants) == $this->tournament->competitors_limit) {
            return false;
        }

        return !$this->isUserRegistered;
    }

    public function getParticipants()
    {
        return $this->participants;
    }

    public function getParticipantsTemplate()
    {
        switch ($this->getFormat()) {
            case TournamentFormatEnum::FORMAT_1V1:
                return '@app/modules/main/views/tournaments/participants/duel';
            case TournamentFormatEnum::FORMAT_2V2:
                return '@app/modules/main/views/tournaments/participants/wingman';
            case TournamentFormatEnum::FORMAT_5V5:
                return '@app/modules/main/views/tournaments/participants/competitive';
        }

        return '';
    }

    public function getRegisterForm()
    {
        if (Yii::$app->user->isGuest) {
            return null;
        }

        switch ($this->getFormat()) {
            case TournamentFormatEnum::FORMAT_1V1:
                $form = new RegisterDuelForm();
                $form->tournament_id = $this->tournament->id;
                $form->user_id = Yii::$app->user->id;
                $form->loadData();
                return $form;
            case TournamentFormatEnum::FORMAT_2V2:
                $team = $this->getUserTeam();
                $form = new RegisterWingmanForm();
                $form->tournament_id = $this->tournament->id;
                $form->team = $team;
                $form->team_id = $team ? $team->id : null;
                $form->checkTeam();
                return $form;
            case TournamentFormatEnum::FORMAT_5V5:
                $team = $this->getUserTeam();
                $form = new RegisterCompetitiveForm();
                $form->tournament_id = $this->tournament->id;
                $form->team = $team;
                $form->team_id = $team ? $team->id : null;
                return $form;
        }

        return null;
    }

    public function getRegisterFormTemplate()
    {
        switch ($this->getFormat()) {
            case TournamentFormatEnum::FORMAT_1V1:
                return '@app/modules/main/views/tournaments/forms/duel';
            case TournamentFormatEnum::FORMAT_2V2:
                return '@app/modules/main/views/tournaments/forms/wingman';
            case TournamentFormatEnum::FORMAT_5V5:
                return '@app/modules/main/views/tournaments/forms/competitive';
        }

        return '';
    }

    /**
     * @return array|CustomTeam|null
     */
    private function getUserTeam()
    {
        $team = null;

        if (Yii::$app->user->isGuest) {
            return null;
        }

        $player = Player::find()->where(['user_id' => Yii::$app->user->id])->with(['team'])->all();
        if (sizeof($player)) {
            /** @var Player $record */
            foreach ($player as $record) {
                if ($record->team->format == $this->getFormat()) {
                    $team = $record->team;
                    break;
                }
            }
        }

        return $team;
    }
}
