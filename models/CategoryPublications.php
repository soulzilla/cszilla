<?php

namespace app\models;

use app\components\core\ActiveRecord;

/**
 * Class CategoryPublications
 * @package app\models
 *
 * @property int $id
 * @property int $category_id
 * @property int $count
 * @property Category $category
 */
class CategoryPublications extends ActiveRecord
{
    public static function tableName()
    {
        return 'category_publications';
    }

    public function rules()
    {
        return [
            [['category_id', 'count'], 'integer']
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }
}