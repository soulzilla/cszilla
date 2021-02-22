<?php

namespace app\services;

use app\components\core\Service;
use app\components\helpers\ArrayHelper;
use app\enums\TournamentFormatEnum;
use app\models\CustomTeam;
use app\models\Profile;
use app\models\Tournament;

class TournamentsService extends Service
{
    public function getModel()
    {
        return new Tournament();
    }

    public function getCompetitors($id)
    {
        /** @var Tournament $model */
        $model = $this->findOne($id);

        if ($model->format == TournamentFormatEnum::FORMAT_1V1) {
            return ArrayHelper::map(Profile::find()->all(), 'id', 'name');
        }

        return ArrayHelper::map(CustomTeam::find()->all(), 'id', 'name');
    }
}
