<?php

namespace app\modules\dashboard\controllers;

use app\components\core\DashboardController;
use app\services\ReviewsService;
use app\services\UsersService;

class ReviewsController extends DashboardController
{
    public function __construct(
        $id, $module,
        ReviewsService $reviewsService,
        UsersService $usersService,
        $config = [])
    {
        parent::__construct($id, $module, $usersService, $config);
        $this->service = $reviewsService;
    }

    public function actionHide($id)
    {
        $this->service->hide($id);

        return $this->redirect(['view', 'id' => $id]);
    }

    public function actionPublish($id)
    {
        $this->service->publish($id);

        return $this->redirect(['view', 'id' => $id]);
    }

    public function allowedRoles()
    {
        return ['ROLE_MODERATOR'];
    }
}
