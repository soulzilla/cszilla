<?php

namespace app\modules\main\controllers\base;

use app\components\core\Controller;
use app\components\core\Service;
use app\models\Bookmaker;
use app\models\Casino;
use app\models\LootBox;
use yii\web\NotFoundHttpException;

class PartnerController extends Controller
{
    /* @var Service */
    protected $partnerService;

    public function actionIndex()
    {
        $model = $this->partnerService->getModel();
        $query = $model::find()
            ->where([
                'is_published' => 1
            ])->orderBy([
                'order' => SORT_ASC
            ])->with([
                'overview', 'complaint'
            ]);

        $query->orderBy([$model->tableName() . '.order' => SORT_ASC]);

        $provider = $this->partnerService->getDataProvider($query);
        $provider->pagination->setPageSize(20);

        return $this->render('index', [
            'provider' => $provider
        ]);
    }

    /**
     * @param $name_canonical
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($name_canonical)
    {
        /** @var Bookmaker|Casino|LootBox $model */

        $modelClass = $this->partnerService->getModel();
        $query = $modelClass::find()->where([
            $this->partnerService->getModel()->tableName().'.name_canonical' => $name_canonical,
            $this->partnerService->getModel()->tableName().'.is_published' => 1
        ])->with([
            'bonuses',
            'promoCodes',
            'attachedItems'
        ])->joinWith([
            'seo', 'counter', 'observers', 'rating'
        ]);

        if ($modelClass instanceof LootBox) {
           $query->with(['boxes']);
        }
        if ($modelClass instanceof Bookmaker) {
            $query->with(['lines']);
        }
        if ($modelClass instanceof Casino) {
            $query->with(['modes']);
        }

        $model = $query->one();

        if (!$model) {
            throw new NotFoundHttpException();
        }

        $model->addView();

        return $this->render('view', [
            'model' => $model
        ]);
    }
}
