<?php

namespace app\components\traits;

trait SoftDeleteTrait
{
    public function blockById($id)
    {
        return $this->getModel()::updateAll(['is_blocked' => 1], ['id' => $id]);
    }

    public function unblockById($id)
    {
        return $this->getModel()::updateAll(['is_blocked' => 0], ['id' => $id]);
    }

    public function restoreById($id)
    {
        return $this->getModel()::updateAll(['is_deleted' => 0], ['id' => $id]);
    }
}