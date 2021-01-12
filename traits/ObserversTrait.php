<?php

namespace app\traits;

use app\models\ObserversCounter;

/**
 * Trait ObserversTrait
 * @package app\traits
 *
 * @property ObserversCounter $observers
 */
trait ObserversTrait
{
    public function getObservers()
    {
        return $this->hasOne(ObserversCounter::class, ['entity_id' => 'id'])->onCondition(['observers_counters.entity_table' => $this->tableName()]);
    }
}
