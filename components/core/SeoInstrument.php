<?php

namespace app\components\core;

use yii\base\Component;

class SeoInstrument extends Component
{
    /* заголовок */
    public $title;

    /* ключевые слова для поиска, длина 255 */
    public $keywords;

    /* описание охват основных ключевых фраз */
    public $description;

    /* тема страницы */
    public $subject;

    /* компания владелец */
    public $copyright = 'cszilla';

    /* автор статьи */
    public $author;

    /* язык контента */
    public $language = 'Russian';

    /* правила индексации для страницы */
    public $robots = 'index, follow';

    /* то же, что и description */
    public $abstract;

    /* по умолчанию контент сайта динамичный */
    public $document_state = 'Dynamic';

    /* указания роботам, с какой частотой обновлять индексацию страницы */
    public $revisit = 7;

    /* HTTP-EQUIV */
    public $content_language = 'ru';
    public $content_type = 'text/html; charset=UTF-8';

    /* OpenGraph */
    /* Заголовок */
    public $og_title;
    public $og_description;
    public $og_url;
    public $og_image = '/images/logo.png';
    public $og_site_name = 'CSZilla';
}
