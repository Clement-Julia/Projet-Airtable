<?php

class Championnat extends AdminModels {
    private $nom;

    public function __construct($var = null) {
        $this->var = $var;
    }

    function getChampionnatsJSON()
    {
        return $this->InitCurl('championnats');
    }
}