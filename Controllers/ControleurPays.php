<?php
require_once "AdminControleur.php";

class ControleurPays extends AdminControleur {

    public function getPays(){
        $Pays = new Pays();
        return json_decode($Pays->getPaysJSON());
    }
}

?>