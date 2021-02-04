<?php
/** @var app\components\core\SeoInstrument $instrument */
/** @var yii\web\View $this */

use app\components\helpers\StringHelper;
use app\components\helpers\Url;

$instrument = Yii::$app->seo;

$this->registerMetaTag(['name' => 'title', 'content' => $instrument->title ?? $this->title]);
$this->registerMetaTag(['name' => 'subject', 'content' => $instrument->subject ?? $this->title]);
$this->registerMetaTag(['name' => 'description', 'content' => $instrument->description ?? StringHelper::getDefaultDescription()]);
$this->registerMetaTag(['name' => 'keywords', 'content' => $instrument->description ?? StringHelper::getDefaultKeywords()]);
$this->registerMetaTag(['name' => $instrument->author ? 'author' : 'copyright', 'content' => $instrument->author ?? $instrument->copyright]);
$this->registerMetaTag(['name' => 'language', 'content' => $instrument->language]);
$this->registerMetaTag(['name' => 'robots', 'content' => $instrument->robots]);
$this->registerMetaTag(['name' => 'abstract', 'content' => $instrument->description ?? StringHelper::getDefaultDescription()]);
$this->registerMetaTag(['name' => 'document-state', 'content' => $instrument->document_state]);
$this->registerMetaTag(['name' => 'revisit', 'content' => $instrument->revisit]);

$this->registerMetaTag(['http-equiv' => 'content-language', 'content' => $instrument->content_language]);
$this->registerMetaTag(['http-equiv' => 'content-type', 'content' => $instrument->content_type]);

$this->registerMetaTag(['name' => 'og:title', 'content' => $instrument->og_title ?? $this->title]);
$this->registerMetaTag(['name' => 'og:description', 'content' => $instrument->og_description ?? StringHelper::getDefaultDescription()]);
$this->registerMetaTag(['name' => 'og:url', 'content' => $instrument->og_url ?? Url::current([],'https')]);
$this->registerMetaTag(['name' => 'og:image', 'content' => Yii::$app->request->hostInfo . $instrument->og_image]);
$this->registerMetaTag(['name' => 'og:site_name', 'content' => $instrument->og_site_name]);
