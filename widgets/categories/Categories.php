<?php

namespace app\widgets\categories;

use app\services\CategoriesService;
use yii\bootstrap4\Widget;

class Categories extends Widget
{
    private $categoriesService;

    public function __construct(CategoriesService $categoriesService, $config = [])
    {
        parent::__construct($config);
        $this->categoriesService = $categoriesService;
    }

    public function run()
    {
        $categories = $this->categoriesService->getModel()::find()
            ->where(['categories.is_published' => 1])
            ->joinWith(['counter'])
            ->orderBy(['categories.order' => SORT_ASC])
            ->cache(300)
            ->all();

        return $this->render('index', [
            'models' => $categories
        ]);
    }
}
