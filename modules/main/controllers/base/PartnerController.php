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
        $query = $this->partnerService->getModel()::find()
            ->where([
                'is_published' => 1
            ])->orderBy([
                'order' => SORT_ASC
            ])->with([
                'bonus', 'promoCode'
            ]);
        if ($query->modelClass == LootBox::class) {
            $query->with(['bonus', 'promoCode', 'boxes']);
        }

        $provider = $this->partnerService->getDataProvider($query);

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
        $model = $this->partnerService->getModel()::find()
            ->where([
                $this->partnerService->getModel()->tableName().'.name_canonical' => $name_canonical,
                $this->partnerService->getModel()->tableName().'.is_published' => 1
            ])->with([
                'ratings', 'complaints', 'overviews', 'bonuses', 'promoCodes'
            ])->joinWith([
                'seo', 'counter', 'observers'
            ])->one();

        if (!$model) {
            throw new NotFoundHttpException();
        }

        $model->addView();

        return $this->render('view', [
            'model' => $model
        ]);
    }
}
