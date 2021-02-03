<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\models\Contest;
use app\models\ContestParticipant;
use app\services\ContestsService;
use app\services\UsersService;
use Yii;
use yii\db\Expression;

class ContestsController extends DashboardController
{
    public function __construct($id, $module, UsersService $usersService, ContestsService $service, $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }

    public function actionRoll($id)
    {
        /** @var Contest $model */
        $model = Contest::find()->where(['id' => $id])->with(['winners', 'prizes'])->one();

        /*if ($model->date_end > date('Y-m-d H:i:s')) {
            return $this->redirect(['view', 'id' => $model->id]);
        }*/

        $winners = [];

        if (sizeof($model->winners) < $model->winners_count) {
            $randExp = new Expression('random()');

            if (Yii::$app->db->getDriverName() == 'mysql') {
                $randExp = new Expression('rand()');
            }

            $limit = $model->winners_count - sizeof($model->winners);

            $winners = ContestParticipant::find()
                ->where(['contest_id' => $model->id, 'is_winner' => 0])
                ->with(['user'])
                ->limit($limit)
                ->orderBy($randExp)
                ->indexBy('id')
                ->all();

            if (sizeof($winners)) {
                ContestParticipant::updateAll(['is_winner' => 1], ['in', 'id', array_keys($winners)]);
            }
        }

        $winners = array_merge($winners, $model->winners);

        return $this->render('roll', [
            'model' => $model,
            'winners' => $winners
        ]);
    }

    public function actionReset($id)
    {
        $participant = ContestParticipant::findOne($id);

        if ($participant) {
            $participant->delete();
        }

        return $this->redirect(['roll', 'id' => $participant->contest_id]);
    }

    public function allowedRoles()
    {
        return ['ROLE_EDITOR'];
    }
}
