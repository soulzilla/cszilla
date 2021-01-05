<?php

namespace app\components\traits;

use app\enums\EntityTablesEnum;
use app\models\Bookmaker;
use app\models\Casino;
use app\models\LootBox;

/**
 * Trait EntityRelationsTrait
 * @package app\components\traits
 *
 * @property Bookmaker $bookmaker
 * @property Casino $casino
 * @property LootBox $lootBox
 */
trait EntityRelationsTrait
{

    /**
     * @return Bookmaker|Casino|LootBox|null
     */
    public function getEntity()
    {
        switch ($this->entity_table) {
            case EntityTablesEnum::TABLE_BOOKMAKERS:
                return $this->bookmaker;
            case EntityTablesEnum::TABLE_CASINOS:
                return $this->casino;
            case EntityTablesEnum::TABLE_LOOT_BOXES:
                return $this->lootBox;
        }

        return null;
    }

    public function getBookmaker()
    {
        return $this->hasOne(Bookmaker::class, ['id' => 'entity_id']);
    }

    public function getCasino()
    {
        return $this->hasOne(Casino::class, ['id' => 'entity_id']);
    }

    public function getLootBox()
    {
        return $this->hasOne(LootBox::class, ['id' => 'entity_id']);
    }
}