<?php

namespace app\commands;

use app\enums\MatchResultEnum;
use app\models\MatchResult;
use app\models\Prediction;
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
}
