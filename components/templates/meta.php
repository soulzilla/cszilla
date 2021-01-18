<?php

use app\components\helpers\StringHelper;
use app\traits\SeoTrait;

/** @var $model SeoTrait|null */

if (isset($model) && $model && $model->seo) {
    $this->registerMetaTag([
        'name' => 'title',
        'content' => $model->seo->title
    ]);

    $this->registerMetaTag([
        'name' => 'description',
        'content' => $model->seo->description
    ]);

    $this->registerMetaTag([
        'name' => 'keywords',
        'content' => $model->seo->keywords ?? StringHelper::getDefaultKeywords()
    ]);

    if ($model->seo->noindex) {
        $this->registerMetaTag([
            'name' => 'robots',
            'content' => 'noindex, nofollow'
        ]);
    }
} else {
    $this->registerMetaTag([
        'name' => 'title',
        'content' => $this->title
    ]);

    $this->registerMetaTag([
        'name' => 'description',
        'content' => 'CSZilla - лучший сайт по игре'
    ]);

    $this->registerMetaTag([
        'name' => 'keywords',
        'content' => StringHelper::getDefaultKeywords()
    ]);
}
