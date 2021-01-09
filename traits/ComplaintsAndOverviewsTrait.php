<?php

namespace app\traits;

use app\models\Complaint;
use app\models\Overview;

/**
 * Trait ComplaintsAndOverviewsTrait
 * @package app\traits
 *
 * @property Complaint[] $complaints
 * @property Overview[] $overviews
 */
trait ComplaintsAndOverviewsTrait
{
    public function getComplaints()
    {
        return $this->hasMany(Complaint::class, ['entity_id' => 'id'])
            ->onCondition([
                'complaints.entity_table' => $this->tableName(),
                'complaints.is_deleted' => 0
            ]);
    }

    public function getOverviews()
    {
        return $this->hasMany(Overview::class, ['entity_id' => 'id'])
            ->onCondition([
                'overviews.entity_table' => $this->tableName(),
                'overviews.is_deleted' => 0
            ]);
    }
}
