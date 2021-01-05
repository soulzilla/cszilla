<?php

namespace app\services;

use app\components\core\Service;
use app\models\Contest;
use app\models\ContestParticipant;
use yii\db\Expression;

class ContestsService extends Service
{
    public function getModel()
    {
        return new Contest();
    }

    public function roll($contest_id, $place)
    {
        /* @var ContestParticipant $participant */
        $participant = ContestParticipant::find()->where([
            'contest_id' => $contest_id,
            'is_winner' => 0
        ])->orderBy('RANDOM()')->joinWith([
            'user'
        ])->limit(1)->one();

        if (!$participant) {
            return [
                'name' => ''
            ];
        }

        $participant->is_winner = $place;
        $participant->save();

        return [
            'name' => $participant->user->name
        ];
    }
}
