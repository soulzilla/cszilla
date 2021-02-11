<?php

namespace app\commands;

use app\enums\MatchResultEnum;
use app\models\GameMatch;
use app\models\MatchResult;
use app\models\Prediction;
use app\models\PredictionCounter;
use yii\console\Controller;

class ResultsController extends Controller
{
    public function actionIndex()
    {
        /** @var MatchResult[] $results */
        $results = MatchResult::find()->where([
            'state' => MatchResultEnum::STATE_NEW
        ])->all();

        if (!sizeof($results)) {
            return;
        }

        foreach ($results as $result) {
            $result->state = MatchResultEnum::STATE_IN_PROGRESS;
            $result->save();

            /** @var Prediction[] $predictions */
            $predictions = Prediction::find()->where(['match_id' => $result->match_id])->all();

            if (!sizeof($predictions)) {
                $result->state = MatchResultEnum::STATE_DONE;
                $result->save();
                continue;
            }

            foreach ($predictions as $prediction) {
                if ($prediction->selected_team == $result->winner_team) {
                    $prediction->is_winner = 1;
                    $prediction->save();
                }
            }

            $result->state = MatchResultEnum::STATE_DONE;
            $result->save();
        }
    }

    public function actionFix()
    {
        $matches = GameMatch::find()->select('id')->column();
        Prediction::deleteAll(['not in', 'id', $matches]);

        $counters = PredictionCounter::find()->where(['<>', 'predictions', 0])->all();
        /** @var PredictionCounter $counter */
        foreach ($counters as $counter) {
            $predictions = Prediction::find()->where(['user_id' => $counter->user_id])->all();
            $counter->predictions = sizeof($predictions);
            $success = 0;
            /** @var Prediction $prediction */
            foreach ($predictions as $prediction) {
                if ($prediction->is_winner) {
                    $success += 1;
                }
            }
            $counter->success_predictions = $success;
            $win_rate = (int) (($success/$counter->predictions) * 100);
            $counter->win_rate = (string) $win_rate;
            $counter->save();
        }
    }
}
