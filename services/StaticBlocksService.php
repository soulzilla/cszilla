<?php

namespace app\services;

use app\components\core\Service;
use app\enums\StaticBlockEnum;
use app\models\StaticBlock;

class StaticBlocksService extends Service
{
    private $staticBlocks;

    public function getModel()
    {
        return new StaticBlock();
    }

    /**
     * @return StaticBlock|null
     */
    public function getTop()
    {
        if ($this->staticBlocks) {
            return $this->staticBlocks[StaticBlockEnum::TYPE_TOP];
        }
        return null;
    }

    /**
     * @return StaticBlock|null
     */
    public function getMainDescription()
    {
        if ($this->staticBlocks) {
            return $this->staticBlocks[StaticBlockEnum::TYPE_MAIN_DESCRIPTION];
        }
        return null;
    }

    /**
     * @return StaticBlock|null
     */
    public function getNewsDescription()
    {
        if ($this->staticBlocks) {
            return $this->staticBlocks[StaticBlockEnum::TYPE_NEWS_DESCRIPTION];
        }
        return null;
    }

    public function getSocialLinks()
    {
        $links = [];
        if ($this->staticBlocks) {
            if (isset($this->staticBlocks[StaticBlockEnum::SOCIAL_VK])) {
                $links[] = $this->staticBlocks[StaticBlockEnum::SOCIAL_VK];
            }
            if (isset($this->staticBlocks[StaticBlockEnum::SOCIAL_INSTAGRAM])) {
                $links[] = $this->staticBlocks[StaticBlockEnum::SOCIAL_INSTAGRAM];
            }
            if (isset($this->staticBlocks[StaticBlockEnum::SOCIAL_YOUTUBE])) {
                $links[] = $this->staticBlocks[StaticBlockEnum::SOCIAL_YOUTUBE];
            }
            if (isset($this->staticBlocks[StaticBlockEnum::SOCIAL_TELEGRAM])) {
                $links[] = $this->staticBlocks[StaticBlockEnum::SOCIAL_TELEGRAM];
            }
            if (isset($this->staticBlocks[StaticBlockEnum::SOCIAL_TWITCH])) {
                $links[] = $this->staticBlocks[StaticBlockEnum::SOCIAL_TWITCH];
            }
        }

        return $links;
    }

    public function init()
    {
        parent::init();
        $blocks = StaticBlock::find()
            ->andWhere(['is_deleted' => 0])
            ->indexBy('type')
            ->cache(6000)
            ->all();
        $this->staticBlocks = $blocks;
    }
}
