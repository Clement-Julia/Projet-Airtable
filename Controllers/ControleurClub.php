<?php
require_once "AdminControleur.php";

class ControleurClub extends AdminControleur {

    public function getClub(){
        $Clubs = new Club();
        return json_decode($Clubs->getClubsJSON());
    }
}

?>