<?php

namespace app\filters;

use app\components\core\ActiveQuery;
use app\components\core\Filter;

class PublicationsFilter extends Filter
{
    public $title;
    public $body;

    public function applyFilter(ActiveQuery $query, $params = [])
    {
        parent::applyFilter($query, $params);

        if ($this->title) {
            $query->soundEx(['title' => $this->title]);
            $query->phoneme(['title' => $this->title]);
            $query->trigram(['title' => $this->title]);
        }

        if ($this->body) {
            $query->soundEx(['body' => $this->body]);
            $query->phoneme(['body' => $this->body]);
            $query->trigram(['body' => $this->body]);
        }
    }
}
