<?php

namespace app\modules\main\controllers;

use app\components\core\Controller;
use app\models\Contest;
use app\models\ContestParticipant;
use app\services\ContestsService;
use app\services\UsersService;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class GiveawaysController extends Controller
{
    private $contestsService;

    public function __construct(
        $id, $module,
        UsersService $usersService,
        ContestsService $contestsService,
        $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->contestsService = $contestsService;
    }

    public function actionIndex()
    {
        $query = Contest::find()
            ->where(['is_published' => 1])
            ->orderBy(['ts' => SORT_DESC])
            ->with(['participants']);

        $provider = $this->contestsService->getDataProvider($query);

        return $this->render('index', [
            'provider' => $provider
        ]);
    }

    public function actionView($id)
    {
        $model = Contest::find()
            ->where([
                'contests.id' => $id,
                'contests.is_published' => 1
            ])
            ->joinWith([
                'counter', 'like', 'participant'
            ])
            ->with([
                'participants', 'prizes'
            ])
            ->one();

        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * @param $id
     * @throws NotFoundHttpException
     */
    public function actionParticipate($id)
    {
        if (!Yii::$app->request->isAjax) {
            throw new NotFoundHttpException();
        }

        $model = new ContestParticipant();
        $model->user_id = Yii::$app->user->id;
        $model->contest_id = $id;
        $model->save();

        $count = ContestParticipant::find()->where([
            'contest_id' => $id
        ])->count();

        $response = [
            'model' => $model,
            'count' => $count
        ];

        Yii::$app->response->format = Response::FORMAT_JSON;
        return $response;
    }
}
