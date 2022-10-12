<?php

class Club extends AdminModels {
    private $nom;
    private $pays;

    public function __construct($var = null) {
        $this->var = $var;
    }

    function getClubsJSON()
    {
        return $this->InitCurl('club');
    }
}