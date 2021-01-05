<?php

namespace app\services;

use app\components\core\Service;
use app\filters\CategoriesFilter;
use app\models\Category;

class CategoriesService extends Service
{
    public $tags;

    public function __construct($config = [])
    {
        parent::__construct($config);
        $this->tags = Category::find()->where(['is_published' => 1])->all();
    }

    public function getFilter()
    {
        return new CategoriesFilter();
    }

    public function getModel()
    {
        return new Category();
    }
}
