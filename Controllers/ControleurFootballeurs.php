<?php
require_once "AdminControleur.php";

class ControleurFootballeurs extends AdminControleur {
    private $nom;
    private $prenom;
    private $club;
    private $link;
    private $championnat;
    private $palmares;

    // public function __construct($name = null) {
    //     if($name){
    //         $Footballeurs = new Footballeurs();

    //         $footballeurs = json_decode($Footballeurs->getFootballeursJSON($name));
    //         foreach($footballeurs->{'records'} as $footballeur){
    //             $this->nom = $footballeur->{'fields'}->{'Nom'};
    //             $this->prenom = $footballeur->{'fields'}->{'Prenom'};
    //             $this->club = reset($footballeur->{'fields'}->{'Club'});
    //             $this->championnat = reset($footballeur->{'fields'}->{'Championnat'});
    //             $this->palmares = reset($footballeur->{'fields'}->{'Palmares'});
    //         }
    //     }
    // }

    public function getFootballeurs($name = null){
        $Footballeurs = new Footballeurs();
        return json_decode($Footballeurs->getFootballeursJSON($name));
    }

    function getPictureName($name, $link){
        $newName = $name;
        $ext = substr($link["name"], strrpos($link["name"], '.'));
        $target_dir = "../Assets/src/";
        $target_file = $target_dir . $newName . $ext;
        if(in_array($ext, [".jpeg", ".png", ".jpg", ".svg"])){
            move_uploaded_file($link["tmp_name"], $target_file);
            chmod($target_file, 0777);
            $link = $newName.$ext;
        }else{
            $link = "error";
        }

        return json_encode($link);
    }
}

?>