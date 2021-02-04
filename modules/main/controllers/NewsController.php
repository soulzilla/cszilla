<?php

namespace app\modules\main\controllers;

use app\components\core\Controller;
use app\components\helpers\StringHelper;
use app\enums\AttachmentsEnum;
use app\models\Category;
use app\models\Publication;
use app\services\PublicationsService;
use app\services\UsersService;
use Yii;
use yii\db\Expression;
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
            ])->andWhere([
                '<', 'publications.publish_date', date('Y-m-d H:i:s')
            ])
            ->joinWith(['category', 'author'])
            ->orderBy([
                'publications.publish_date' => SORT_DESC
            ]);

        if ($category = Yii::$app->request->get('category')) {
            $query->andWhere(['categories.name_canonical' => $category]);
        }

        if ($search = Yii::$app->request->get('query')) {
            $query->andFilterWhere([
                'OR',
                ['like', 'publications.title', strtolower($search)],
                ['like', 'publications.body', strtolower($search)]
            ]);
        }

        $provider = $this->publicationsService->getDataProvider($query);
        $provider->pagination->setPageSize(10);

        $categories = Category::find()->where(['is_published' => 1])->orderBy(['order' => SORT_ASC])->all();

        Yii::$app->seo->revisit = 1;

        return $this->render('index', [
            'provider' => $provider,
            'current' => $category ?? null,
            'categories' => $categories
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
                'publications.is_published' => 1,
                'publications.is_deleted' => 0,
                'publications.is_blocked' => 0
            ])
            ->joinWith([
                'seo', 'author', 'category', 'counter'
            ])
            ->with([
                'attachedItems'
            ])
            ->one();

        if (!$model) {
            throw new NotFoundHttpException();
        }

        $model->addView();

        if ($model->seo) {
            Yii::$app->seo->keywords = $model->seo->keywords ?? StringHelper::getDefaultKeywords();
            Yii::$app->seo->description = $model->seo->description ?? StringHelper::getDefaultDescription();
            Yii::$app->seo->title = $model->seo->title ?? $model->title;
            Yii::$app->seo->robots = $model->seo->noindex ? 'noindex, nofollow' : 'index, follow';
        }

        if (sizeof($model->attachedItems)) {
            foreach ($model->attachedItems as $attachment) {
                if ($attachment->type == AttachmentsEnum::TYPE_IMAGE && strstr($attachment->source, 'https://') === false) {
                    Yii::$app->seo->og_image = $attachment->source;
                    break;
                }
            }
        }

        return $this->render('view', [
            'model' => $model
        ]);
    }
}
