<?php

namespace app\traits;

trait ProsAndConsTrait
{
    public function hasPros()
    {
        $pros = $this->pros;

        if (!is_array($pros)) {
            $pros = json_decode($pros, true);
        }

        if (!sizeof($pros)) {
            return false;
        }

        if ($pros[0] == '') {
            return false;
        }

        return true;
    }

    public function hasCons()
    {
        $cons = $this->cons;

        if (!is_array($cons)) {
            $cons = json_decode($cons, true);
        }

        if (!sizeof($cons)) {
            return false;
        }

        if ($cons[0] == '') {
            return false;
        }

        return true;
    }

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
