<?php

namespace app\components\traits;

use app\models\Bonus;
use app\models\PromoCode;

/**
 * Trait BonusesTrait
 * @package app\components\traits
 *
 * @property Bonus[] $bonuses
 * @property Bonus $bonus
 * @property PromoCode[] $promoCodes
 * @property PromoCode $promoCode
 */
trait BonusesTrait
{
    public function getBonuses()
    {
        return $this->hasMany(Bonus::class, ['entity_id' => 'id'])
            ->onCondition([
                'bonuses.entity_table' => $this->tableName(),
                'bonuses.is_published' => 1,
            ])->orderBy(['pinned' => SORT_DESC]);
    }

    public function getBonus()
    {
        return $this->hasOne(Bonus::class, ['entity_id' => 'id'])->onCondition([
            'bonuses.entity_table' => $this->tableName(),
            'bonuses.is_published' => 1,
            'pinned' => 1
        ]);
    }

    public function getPromoCodes()
    {
        return $this->hasMany(PromoCode::class, ['entity_id' => 'id'])->onCondition([
            'promo_codes.entity_table' => $this->tableName(),
            'promo_codes.is_published' => 1
        ]);
    }

    public function getPromoCode()
    {
        return $this->hasOne(PromoCode::class, ['entity_id' => 'id'])->onCondition([
            'promo_codes.entity_table' => $this->tableName(),
            'promo_codes.is_published' => 1
        ]);
    }
}
