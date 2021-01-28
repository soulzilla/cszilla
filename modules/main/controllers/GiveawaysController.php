<?php

namespace app\modules\main\controllers;

use app\components\core\Controller;
use app\models\Contest;
use app\models\ContestParticipant;
use app\services\ContestsService;
use app\services\UsersService;
use Yii;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
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

        $model->addView();

        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * @param $id
     * @return Response
     * @throws NotFoundHttpException|ForbiddenHttpException|BadRequestHttpException
     */
    public function actionParticipate($id)
    {
        if (!Yii::$app->request->isPost) {
            throw new BadRequestHttpException();
        }

        /** @var Contest $contest */
        $contest = $this->contestsService->findOne($id);

        if (!$contest) {
            throw new NotFoundHttpException();
        }

        if (!$contest->isActive() || !$contest->canParticipate()) {
            throw new ForbiddenHttpException();
        }

        $model = new ContestParticipant();
        $model->user_id = Yii::$app->user->id;
        $model->contest_id = $id;

        if ($model->save()) {
            Yii::$app->session->setFlash('success', 'Вы участвуете в розыгрыше!');
        } else {
            Yii::$app->session->setFlash('error', 'Не удалось записаться на участие.');
        }

        return $this->redirect(['view', 'id' => $id]);
    }
}
