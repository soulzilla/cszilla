<?php

namespace app\traits;

use app\models\Seo;

/**
 * Trait SeoTrait
 * @package app\traits
 *
 * @property Seo $seo
 */
trait SeoTrait
{
    public function getSeo()
    {
        return $this->hasOne(Seo::class, ['entity_id' => 'id'])->onCondition(['seo.entity_table' => $this->tableName()])
            ->cache(300);
    }
}
