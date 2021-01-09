<?php

namespace app\modules\main\controllers;

use app\components\core\Controller;
use app\models\Publication;
use app\services\PublicationsService;
use app\services\UsersService;
use Yii;
use yii\web\NotFoundHttpException;

class NewsController extends Controller
{
    private $publicationsService;

    public function __construct(
        $id, $module,
        UsersService $usersService,
        PublicationsService $publicationsService,
        $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->publicationsService = $publicationsService;
    }

    public function actionIndex()
    {
        $query = Publication::find()
            ->andWhere([
                'publications.is_published' => 1,
                'publications.is_deleted' => 0,
                'publications.is_blocked' => 0
            ])
            ->joinWith(['category', 'author'])
            ->orderBy([
                'publications.publish_date' => SORT_DESC
            ]);

        if ($category = Yii::$app->request->get('category')) {
            $query->andWhere(['categories.name_canonical' => $category]);
        }

        if ($search = Yii::$app->request->get('query')) {
            $query->andFilterWhere(['like', 'publications.body', strtolower($search)]);
        }

        $provider = $this->publicationsService->getDataProvider($query);
        $provider->pagination->setPageSize(10);

        return $this->render('index', [
            'provider' => $provider
        ]);
    }

    /**
     * @param $title_canonical
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($title_canonical)
    {
        /** @var Publication $model */
        $model = Publication::find()
            ->where([
                'publications.title_canonical' => $title_canonical,
                'publications.is_published' => 1
            ])
            ->joinWith([
                'seo', 'author', 'category', 'counter'
            ])
            ->with([
                'likes', 'views'
            ])
            ->one();

        if (!$model) {
            throw new NotFoundHttpException();
        }

        $model->addView();

        return $this->render('view', [
            'model' => $model
        ]);
    }
}
