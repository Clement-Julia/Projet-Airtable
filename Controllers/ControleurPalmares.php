<?php
require_once "AdminControleur.php";

class ControleurPalmares extends AdminControleur {

    public function getPalmares(){
        $Palmares = new Palmares();
        return json_decode($Palmares->getPalmaresJSON());
    }
}

?>