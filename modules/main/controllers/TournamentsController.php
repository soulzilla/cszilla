<?php

namespace app\modules\main\controllers;

use app\components\core\Controller;
use app\components\helpers\StringHelper;
use app\forms\AcceptInviteForm;
use app\forms\TournamentBracketForm;
use app\models\CustomTeam;
use app\models\Player;
use app\models\Tournament;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class TournamentsController extends Controller
{
    public function actionIndex()
    {
        $query = Tournament::find()->andWhere([
            'is_published' => 1
        ]);

        $state = Yii::$app->request->get('state', 'active');
        if ($state == 'active') {
            $query->andWhere(['is_finished' => 0])->orderBy(['date_start' => SORT_ASC]);
        } else {
            $query->andWhere(['is_finished' => 1])->orderBy(['date_start' => SORT_DESC]);
        }
        $query->orderBy(['serial_number' => SORT_DESC]);

        $provider = new ActiveDataProvider([
            'query' => $query
        ]);

        return $this->render('index', [
            'provider' => $provider,
            'state' => $state
        ]);
    }

    public function actionView($id)
    {
        /** @var Tournament $model */
        $model = Tournament::find()
            ->where([
                'id' => $id,
                'is_published' => 1
            ])
            ->with([
                'seo'
            ])
            ->one();

        if (!$model) {
            throw new NotFoundHttpException();
        }

        $bracket = new TournamentBracketForm($model);
        $form = $bracket->getRegisterForm();

        if ($model->seo) {
            Yii::$app->seo->keywords = $model->seo->keywords ?? StringHelper::getDefaultKeywords();
            Yii::$app->seo->description = $model->seo->description ?? StringHelper::getDefaultDescription();
            Yii::$app->seo->title = $model->seo->title ?? $model->title;
            Yii::$app->seo->robots = $model->seo->noindex ? 'noindex, nofollow' : 'index, follow';
        }

        $model->addView();

        if ($postData = Yii::$app->request->post($form->formName())) {
            $form->load($postData);
            if ($form->save()) {
                return $this->redirect(['view', 'id' => $id]);
            }
        }

        return $this->render('view', [
            'model' => $model,
            'bracket' => $bracket,
            'form' => $form
        ]);
    }

    public function actionRegisterTeam($format)
    {
        $player = Player::find()->where(['user_id' => Yii::$app->user->id])->with(['team'])->all();
        $team = null;

        if ($player) {
            /** @var Player $record */
            foreach ($player as $record) {
                $model = $record->team;
                if ($model && $model->format == $format) {
                    $team = $model;
                }
            }
        }

        if ($team) {
            return $this->redirect(['index']);
        }

        $team = new CustomTeam();
        $team->format = $format;
        $team->user_id = Yii::$app->user->id;
        $team->invite_code = Yii::$app->security->generateRandomString(10);

        $postData = Yii::$app->request->post('CustomTeam');
        $team->attributes = $postData;

        if ($postData && $team->save()) {
            return $this->redirect(Yii::$app->request->referrer);
        }

        return $this->render('register_team', [
            'model' => $team
        ]);
    }

    public function actionInvite($code)
    {
        if (Yii::$app->user->isGuest) {
            throw new ForbiddenHttpException('Авторизуйтесь для просмотра этой страницы.');
        }

        $team = CustomTeam::find()->where(['invite_code' => $code])->one();

        if (!$team) {
            throw new NotFoundHttpException();
        }

        $player = Player::find()->where(['team_id' => $team->id, 'user_id' => Yii::$app->user->id])->one();

        if ($player) {
            throw new BadRequestHttpException('Вы уже состоите в этой команде.');
        }

        $model = new AcceptInviteForm();
        $model->team_id = $team->id;
        $model->loadData();

        $postData = Yii::$app->request->post('AcceptInviteForm');

        if ($postData) {
            $model->attributes = $postData;
            if ($model->save()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('invite', [
            'model' => $model,
            'team' => $team
        ]);
    }
}
