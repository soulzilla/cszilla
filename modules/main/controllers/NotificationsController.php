<?php

namespace app\modules\main\controllers;

use app\components\core\Controller;
use app\models\Notification;
use app\models\Observer;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class NotificationsController extends Controller
{
    public function beforeAction($action)
    {
        throw new NotFoundHttpException();
    }

    /**
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionIndex()
    {
        throw new NotFoundHttpException();

        if (Yii::$app->user->isGuest) {
            return $this->redirect(['/']);
        }

        /** @var Observer[] $observers */
        $observers = Observer::find()->where([
            'user_id' => Yii::$app->user->id
        ])->all();

        $query = Notification::find()->andWhere([
            'target_id' => Yii::$app->user->id
        ]);

        if (sizeof($observers)) {
            foreach ($observers as $observer) {
                $query->orWhere([
                    'AND',
                    [
                        'target_id' => -1,
                        'source_id' => $observer->entity_id,
                        'source_table' => $observer->entity_table
                    ],
                    [
                        '>', 'ts', $observer->ts
                    ]
                ]);
            }
        }

        $query->with(['status'])->orderBy(['ts' => SORT_DESC])->limit(10);

        $models = $query->all();

        return $this->render('index', [
            'models' => $models
        ]);
    }
}
