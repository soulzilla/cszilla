<?php

namespace app\traits;

use app\models\Complaint;
use app\models\Overview;
use Yii;

/**
 * Trait ComplaintsAndOverviewsTrait
 * @package app\traits
 *
 * @property Complaint[] $complaints
 * @property Overview[] $overviews
 *
 * @property Complaint $complaint
 * @property Overview $overview
 */
trait ComplaintsAndOverviewsTrait
{
    public function getComplaint()
    {
        return $this->hasOne(Complaint::class, ['entity_id' => 'id'])
            ->onCondition([
                'complaints.entity_table' => $this->tableName(),
                'complaints.is_deleted' => 0,
                'complaints.user_id' => Yii::$app->user->id
            ]);
    }

    public function getOverview()
    {
        return $this->hasOne(Overview::class, ['entity_id' => 'id'])
            ->onCondition([
                'overviews.entity_table' => $this->tableName(),
                'overviews.is_deleted' => 0,
                'overviews.is_blocked' => 0,
                'overviews.user_id' => Yii::$app->user->id
            ]);
    }

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
                'overviews.is_deleted' => 0,
                'overviews.is_blocked' => 0
            ]);
    }
}
