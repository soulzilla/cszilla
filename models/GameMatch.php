<?php

namespace app\models;

use app\behaviors\SitemapBehavior;
use app\components\core\ActiveRecord;
use app\components\helpers\Url;
use app\enums\MatchResultEnum;
use app\traits\CounterTrait;
use Yii;

/**
 * This is the model class for table "game_matches".
 *
 * @property int $id
 * @property int $first_team
 * @property int $second_team
 * @property int|null $winner_team
 * @property string $start_ts
 * @property int $is_finished
 * @property string $ts
 * @property string $final_score
 *
 * @property Team $firstTeam
 * @property Team $secondTeam
 * @property Prediction $prediction
 */
class GameMatch extends ActiveRecord
{
    use CounterTrait;

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
            [['first_team', 'second_team', 'winner_team', 'is_finished'], 'integer'],
            [['start_ts', 'final_score'], 'string'],
        ];
    }

    public function behaviors()
    {
        return [
            'sitemap' => [
                'class' => SitemapBehavior::class
            ]
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
            'is_finished' => 'Завершён',
            'final_score' => 'Конечный счёт'
        ];
    }

    public function beforeSave($insert)
    {
        if (!$insert && $this->winner_team) {
            $this->createConsoleTask();
        }

        return parent::beforeSave($insert);
    }

    private function createConsoleTask()
    {
        $matchResult = MatchResult::find()->where(['match_id' => $this->id])->one();
        if ($matchResult) {
            return;
        }
        $matchResult = new MatchResult();
        $matchResult->winner_team = $this->winner_team;
        $matchResult->match_id = $this->id;
        $matchResult->state = MatchResultEnum::STATE_NEW;
        $matchResult->save();
    }

    public function getFirstTeam()
    {
        return $this->hasOne(Team::class, ['id' => 'first_team']);
    }

    public function getsecondTeam()
    {
        return $this->hasOne(Team::class, ['id' => 'second_team']);
    }

    public function getWinnerTeam()
    {
        if (!$this->winner_team) {
            return null;
        }

        if ($this->winner_team == $this->first_team) {
            return $this->firstTeam->name;
        }

        if ($this->winner_team == $this->second_team) {
            return $this->secondTeam->name;
        }

        return null;
    }

    public function getPrediction()
    {
        return $this->hasOne(Prediction::class, ['match_id' => 'id'])->onCondition(['predictions.user_id' => Yii::$app->user->id]);
    }

    public function isWinner($team_id)
    {
        if (!$this->winner_team) {
            return false;
        }

        return $this->winner_team == $team_id;
    }

    public function canPredict()
    {
        if (Yii::$app->user->isGuest) {
            return false;
        }

        if (strtotime($this->start_ts) < time() || $this->is_finished) {
            return false;
        }

        if (!($wallet = Yii::$app->user->identity->wallet)) {
            return false;
        }

        if ($this->prediction) {
            return false;
        }

        if ($wallet->coins > 0) {
            return true;
        }

        return false;
    }

    public function predictionStatus($team_id)
    {
        if (!$this->prediction || $this->prediction->selected_team != $team_id) {
            return '';
        }

        if ($this->winner_team == $team_id && $this->prediction->selected_team == $team_id) {
            return 'text-success';
        }

        if (!$this->winner_team && $this->prediction->selected_team == $team_id) {
            return 'text-warning';
        }

        return 'text-danger';
    }

    public function afterDelete()
    {
        $predictions = Prediction::find()->where(['match_id' => $this->id])->all();

        if (sizeof($predictions)) {
            /** @var Prediction $prediction */
            foreach ($predictions as $prediction) {
                /** @var PredictionCounter $counter */
                $counter = PredictionCounter::find()->where(['user_id' => $prediction->user_id])->one();
                $currentPredictions = $counter->predictions;
                $currentPredictions -= 1;
                $counter->predictions = $currentPredictions;
                $counter->save();

                $prediction->delete();
            }
        }

        parent::afterDelete();
    }

    public function getSitemapUrl(): string
    {
        return Url::to(['/main/match-center/view', 'id' => $this->id]);
    }
}
