<?php

class Pays extends AdminModels {
    private $nom;

    public function __construct($var = null) {
        $this->var = $var;
    }
    
    function getPaysJSON()
    {
        return $this->InitCurl('pays');
    }
}