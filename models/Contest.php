<?php

namespace app\models;

use app\behaviors\SitemapBehavior;
use app\components\core\ActiveRecord;
use app\components\helpers\Url;
use app\traits\SeoTrait;
use app\traits\CounterTrait;
use app\enums\EntityTablesEnum;
use Yii;

/**
 * This is the model class for table "contests".
 *
 * @property int $id
 * @property string $description
 * @property string $date_start
 * @property string $date_end
 * @property int $partner_id
 * @property string $partner_type
 * @property int $is_published
 * @property int $winners_count
 * @property string|null $ts
 *
 * @property Bookmaker $bookmaker
 * @property Casino $casino
 * @property LootBox $lootBox
 * @property Bookmaker|Casino|LootBox $partner
 * @property ContestParticipant[] $participants
 * @property ContestParticipant $participant
 * @property ContestParticipant[] $winners
 * @property Prize[] $prizes
 */
class Contest extends ActiveRecord
{
    use SeoTrait, CounterTrait;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'date_end'], 'required'],
            [['description'], 'string'],
            [['date_start', 'date_end'], 'safe'],
            [['partner_id', 'is_published', 'winners_count'], 'integer'],
            [['partner_type'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [
            'sitemap' => [
                'class' => SitemapBehavior::class,
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Описание',
            'date_start' => 'Время начала',
            'date_end' => 'Время завершения',
            'partner_id' => 'Партнёр',
            'partner_type' => 'Тип партнёра',
            'is_published' => 'Опубликовано',
            'winners_count' => 'Количество победителей',
            'ts' => 'Дата создания',
        ];
    }
    /**
     * @return Bookmaker|Casino|LootBox|null
     */
    public function getPartner()
    {
        switch ($this->partner_type) {
            case EntityTablesEnum::TABLE_BOOKMAKERS:
                return $this->bookmaker;
            case EntityTablesEnum::TABLE_CASINOS:
                return $this->casino;
            case EntityTablesEnum::TABLE_LOOT_BOXES:
                return $this->lootBox;
        }

        return null;
    }

    public function getPartnerUrl()
    {
        switch ($this->partner_type) {
            case EntityTablesEnum::TABLE_BOOKMAKERS:
                return Url::to(['/main/bookmakers/view', 'id' => $this->partner_id]);
            case EntityTablesEnum::TABLE_CASINOS:
                return Url::to(['/main/casinos/view', 'id' => $this->partner_id]);
            case EntityTablesEnum::TABLE_LOOT_BOXES:
                return Url::to(['/main/loot-boxes/view', 'id' => $this->partner_id]);
        }

        return '';
    }

    public function getBookmaker()
    {
        return $this->hasOne(Bookmaker::class, ['id' => 'partner_id']);
    }

    public function getCasino()
    {
        return $this->hasOne(Casino::class, ['id' => 'partner_id']);
    }

    public function getLootBox()
    {
        return $this->hasOne(LootBox::class, ['id' => 'partner_id']);
    }

    public function getParticipants()
    {
        return $this->hasMany(ContestParticipant::class, ['contest_id' => 'id']);
    }

    public function getPrizes()
    {
        return $this->hasMany(Prize::class, ['contest_id' => 'id'])->orderBy(['order' => SORT_ASC]);
    }

    public function isActive()
    {
        if ($this->winners) {
            return false;
        }

        return (time() > strtotime($this->date_start)) && (time() < strtotime($this->date_end));
    }

    public function getParticipant()
    {
        return $this->hasOne(ContestParticipant::class, ['contest_id' => 'id'])->onCondition([
            'contest_participants.user_id' => Yii::$app->user->id
        ]);
    }

    public function getWinners()
    {
        return $this->hasMany(ContestParticipant::class, ['contest_id' => 'id'])->onCondition([
            '<>', 'is_winner', 0
        ]);
    }

    public function getWinnerByPlace($place)
    {
        if (!$this->winners) {
            return null;
        }

        foreach ($this->winners as $winner) {
            if ($winner->is_winner == $place) {
                return $winner;
            }
        }

        return null;
    }

    public function canParticipate()
    {
        if ($this->participant) {
            return false;
        }

        if (Yii::$app->user->identity->profile->steam_url) {
            return true;
        }

        return false;
    }

    public function getSitemapUrl()
    {
        return Url::to(['/main/giveaways/view', 'id' => $this->id]);
    }
}
