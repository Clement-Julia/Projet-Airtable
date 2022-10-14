<?php
require_once "AdminControleur.php";

class ControleurChampionnat extends AdminControleur {

    public function getChampionnats(){
        $Championnats = new Championnat();
        return json_decode($Championnats->getChampionnatsJSON());
    }
}

?>