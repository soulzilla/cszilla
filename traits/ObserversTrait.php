<?php

namespace app\traits;

use app\models\Observer;
use app\models\ObserversCounter;
use Yii;

/**
 * Trait ObserversTrait
 * @package app\traits
 *
 * @property ObserversCounter $observers
 * @property Observer $observer
 */
trait ObserversTrait
{
    public function getObservers()
    {
        return $this->hasOne(ObserversCounter::class, ['entity_id' => 'id'])->onCondition(['observers_counters.entity_table' => $this->tableName()]);
    }

    public function getObserver()
    {
        return $this->hasOne(Observer::class, ['entity_id' => 'id'])
            ->onCondition(['observers.entity_table' => $this->tableName()])
            ->andOnCondition(['observers.user_id' => Yii::$app->user->id]);
    }
}
