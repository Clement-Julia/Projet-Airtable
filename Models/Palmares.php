<?php

class Palmares extends AdminModels {
    private $nom;

    public function __construct($var = null) {
        $this->var = $var;
    }

    // Palmares
    function getPalmaresJSON()
    {
        return $this->InitCurl('palmares');
    }
}