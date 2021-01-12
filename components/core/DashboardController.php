<?php

namespace app\components\core;

use app\models\Seo;
use Yii;
use yii\base\Action;
use yii\db\StaleObjectException;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

class DashboardController extends Controller
{
    /**
     * @var Service
     */
    protected $service;

    public $layout = '@app/modules/dashboard/views/layouts/main';

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['post']
                ],
            ],
        ];
    }

    /**
     * @param Action $action
     * @return bool
     * @throws ForbiddenHttpException
     * @throws BadRequestHttpException
     */
    public function beforeAction($action)
    {
        if ($this->usersService->isGranted(['ROLE_SUPER_ADMIN'])) {
            return parent::beforeAction($action);
        }
        if (sizeof($this->allowedRoles()) && !$this->usersService->isGranted($this->allowedRoles(), false)) {
            throw new ForbiddenHttpException();
        }
        return parent::beforeAction($action);
    }

    public function actionIndex()
    {
        /* @var $filter Filter */
        $query = $this->service->getModel()::find();
        $filter = $this->service->getFilter();

        if ($filter && $queryParams = Yii::$app->request->queryParams) {
            $filter->applyFilter($query, $queryParams);
        }

        $provider = $this->service->getDataProvider($query);

        return $this->render('index', [
            'provider' => $provider,
            'filter' => $filter
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->service->getModel()::findOne($id)
        ]);
    }

    public function actionCreate()
    {
        $model = $this->service->getModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->service->findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    /**
     * @param $id
     * @return Response
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionDelete($id)
    {
        $model = $this->service->findOne($id);

        $model->delete();

        return $this->redirect(['index']);
    }

    public function actionSeo($id)
    {
        $entity = $this->service->findOne($id);

        $model = Seo::find()
            ->where([
                'entity_id' => $entity->id,
                'entity_table' => $entity->tableName()
            ])->one();

        if (!$model) {
            $model = new Seo();
            $model->entity_id = $entity->id;
            $model->entity_table = $entity->tableName();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $id]);
        }

        return $this->render('seo', [
            'model' => $model
        ]);
    }
}
