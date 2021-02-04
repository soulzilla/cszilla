<?php

namespace app\widgets\pager;

use yii\bootstrap4\Html;
use yii\bootstrap4\LinkPager;
use yii\helpers\ArrayHelper;

class Pager extends LinkPager
{
    public $prevPageLabel = '<span class="ion-ios-arrow-back"></span>';
    public $nextPageLabel = '<span class="ion-ios-arrow-forward"></span>';
    public $activePageCssClass = 'nk-pagination-current';

    public function run()
    {
        if ($this->registerLinkTags) {
            $this->registerLinkTags();
        }
        $html = Html::beginTag('nav');
        $html .= $this->renderPageButtons();
        $html .= Html::endTag('nav');

        return $html;
    }

    protected function renderPageButtons()
    {
        $pageCount = $this->pagination->getPageCount();
        if ($pageCount < 2 && $this->hideOnSinglePage) {
            return '';
        }

        $buttons = [];
        $currentPage = $this->pagination->getPage();

        // first page
        $firstPageLabel = $this->firstPageLabel === true ? '1' : $this->firstPageLabel;
        if ($firstPageLabel !== false) {
            $buttons[] = $this->renderPageButton(
                $firstPageLabel,
                0,
                $this->firstPageCssClass,
                $currentPage <= 0,
                false
            );
        }

        // prev page
        if ($this->prevPageLabel !== false) {
            if (($page = $currentPage - 1) < 0) {
                $page = 0;
            }
            $buttons[] = $this->renderPageButton(
                $this->prevPageLabel,
                $page,
                $this->prevPageCssClass,
                $currentPage <= 0,
                false
            );
        }

        // internal pages
        list($beginPage, $endPage) = $this->getPageRange();
        for ($i = $beginPage; $i <= $endPage; ++$i) {
            $buttons[] = $this->renderPageButton(
                $i + 1,
                $i,
                null,
                $this->disableCurrentPageButton && $i == $currentPage,
                $i == $currentPage
            );
        }

        // next page
        if ($this->nextPageLabel !== false) {
            if (($page = $currentPage + 1) >= $pageCount - 1) {
                $page = $pageCount - 1;
            }
            $buttons[] = $this->renderPageButton(
                $this->nextPageLabel,
                $page,
                $this->nextPageCssClass,
                $currentPage >= $pageCount - 1,
                false
            );
        }

        // last page
        $lastPageLabel = $this->lastPageLabel === true ? $pageCount : $this->lastPageLabel;
        if ($lastPageLabel !== false) {
            $buttons[] = $this->renderPageButton(
                $lastPageLabel,
                $pageCount - 1,
                $this->lastPageCssClass,
                $currentPage >= $pageCount - 1,
                false
            );
        }

        return implode('', $buttons);
    }

    protected function renderPageButton($label, $page, $class, $disabled, $active)
    {
        $options = $this->linkContainerOptions;
        Html::addCssClass($options, empty($class) ? $this->pageCssClass : $class);

        $linkOptions = $this->linkOptions;
        $linkOptions['data-page'] = $page;

        if ($active) {
            Html::addCssClass($linkOptions, $this->activePageCssClass);
        }
        if ($disabled) {
            Html::addCssClass($linkOptions, 'disabled');
        }
        Html::removeCssClass($linkOptions, 'page-link');

        return Html::a($label, $this->pagination->createUrl($page), $linkOptions);
    }
}
