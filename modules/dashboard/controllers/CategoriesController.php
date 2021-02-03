<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\models\CategoryPublications;
use app\models\Publication;
use app\services\CategoriesService;
use app\services\UsersService;

class CategoriesController extends DashboardController
{
    public function __construct($id, $module, UsersService $usersService, CategoriesService $service, $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $service;
    }

    public function allowedRoles()
    {
        return ['ROLE_EDITOR'];
    }

    public function actionRecalculate()
    {
        /** @var CategoryPublications[] $counters */
        $counters = CategoryPublications::find()->all();
        if (!sizeof($counters)) {
            return $this->redirect(['index']);
        }

        foreach ($counters as $counter) {
            $counter->count = Publication::find()->where([
                'category_id' => $counter->category_id
            ])->count();
            $counter->save();
        }

        return $this->redirect(['index']);
    }
}
