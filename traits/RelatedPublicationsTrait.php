<?php

namespace app\traits;

use app\models\Publication;
use app\models\RelatedPublication;

/**
 * Trait RelatedPublicationsTrait
 * @package app\traits
 *
 * @property Publication[] $publications
 */
trait RelatedPublicationsTrait
{
    public $related_publications = [];

    public function getPublications()
    {
        return $this->hasMany(Publication::class, ['id' => 'publication_id'])
            ->viaTable(RelatedPublication::tableName(), ['entity_id' => 'id'], function ($query) {
                $query->onCondition(['related_publications.entity_table' => $this->tableName()]);
            });
    }
}
