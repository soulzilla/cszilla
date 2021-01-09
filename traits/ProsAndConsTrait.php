<?php

namespace app\traits;

trait ProsAndConsTrait
{
    public function getPros()
    {
        if (!$this->pros || !sizeof($this->pros)) {
            return '';
        }

        $textPros = '';
        foreach ($this->pros as $pro) {
            $textPros .= "<p class='text-break'>{$pro}</p>";
        }

        return $textPros;
    }

    public function getCons()
    {
        if (!$this->cons || !sizeof($this->cons)) {
            return '';
        }

        $textCons = '';
        foreach ($this->cons as $con) {
            $textCons .= "<p class='text-break'>{$con}</p>";
        }

        return $textCons;
    }
}
