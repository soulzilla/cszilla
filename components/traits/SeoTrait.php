<?php

namespace app\components\traits;

use app\models\Seo;

/**
 * Trait SeoTrait
 * @package app\components\traits
 *
 * @property Seo $seo
 */
trait SeoTrait
{
    public function getSeo()
    {
        return $this->hasOne(Seo::class, ['entity_id' => 'id'])->onCondition(['seo.entity_table' => $this->tableName()]);
    }
}
