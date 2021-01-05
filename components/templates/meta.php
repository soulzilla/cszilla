<?php

if ($model && $model->seo) {
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
        'content' => $model->seo->keywords
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
        'content' => 'CS:GO Heaven - лучший сайт по игре'
    ]);

    $this->registerMetaTag([
        'name' => 'keywords',
        'content' => 'cs, csgo, counter strike, халява, бонусы, промокоды'
    ]);
}
