<?php
require_once("../Models/footballeurs.php");

try{
    if(!empty($_GET['table'])){
        $url = explode("/", filter_var($_GET['table'],FILTER_SANITIZE_URL));
        switch($url[0]){
            case "footballeurs" :
                $Footballeurs = new Footballeurs();
                switch($_GET["method"]){
                    case "get":
                        if(isset($_GET["name"])){
                            print_r($Footballeurs->getFootballeursJSON(ucfirst($_GET["name"])));
                        }else{
                            print_r($Footballeurs->getFootballeursJSON());
                        }
                        break;
                    case "add":
                        $data = [
                            "Nom" => $_POST["Nom"],
                            "Prenom" => $_POST["Prenom"],
                            "clubID" => (isset($_POST["Club"])) ? $_POST["Club"] : null,
                            "championnatsID" => (isset($_POST["Championnat"])) ? $_POST["Championnat"] : null,
                            "palmaresID" => (isset($_POST["Palmares"])) ? $_POST["Palmares"] : null,
                        ];
                        $Footballeurs->addFootballeurs($data, $_FILES["Link"]);
                        header('Location: ../views/footballeurs/profil.php?ftb='.$data["Nom"]);
                        break;
                    case "update":
                        $data = [
                            "Nom" => $_POST["Nom"],
                            "Prenom" => $_POST["Prenom"],
                            "clubID" => (isset($_POST["Club"])) ? $_POST["Club"] : null,
                            "championnatsID" => (isset($_POST["Championnat"])) ? $_POST["Championnat"] : null,
                            "palmaresID" => (isset($_POST["Palmares"])) ? $_POST["Palmares"] : null,
                        ];
                        if($_FILES['Link']['size'] == 0 && $_FILES['Link']['error'] == 0){
                            print_r($Footballeurs->updateFootballeurs($_POST['id'], $data, $_FILES));
                        }else{
                            print_r($Footballeurs->updateFootballeurs($_POST['id'], $data));
                        }
                        header('Location: ../views/footballeurs/profil.php?ftb='.$data["Nom"]);
                        break;
                    default : throw new Exception ("La demande n'est pas valide, vérifiez l'url");
                }
                break;
            case "club" :
                switch($_GET["method"]){
                    case "get":
                        print_r(getClubsJSON());
                        break;
                    case "add":
                        //method
                        break;
                    case "edit":
                        //method
                        break;
                    default : throw new Exception ("La demande n'est pas valide, vérifiez l'url");
                }
                break;
            case "pays":
                switch($_GET){
                    case "get":
                        getFootballeursJSON();
                        break;
                    case "add":
                        //method
                        break;
                    case "edit":
                        //method
                        break;
                    default : throw new Exception ("La demande n'est pas valide, vérifiez l'url");
                }
                break;
            case "championnats":
                switch($_GET["method"]){
                    case "get":
                        print_r(getChampionnatsJSON());
                        break;
                    case "add":
                        //method
                        break;
                    case "edit":
                        //method
                        break;
                    default : throw new Exception ("La demande n'est pas valide, vérifiez l'url");
                }
                break;
            case "palmares":
                switch($_GET["method"]){
                    case "get":
                        print_r(getPalmaresJSON());
                        break;
                    case "add":
                        //method
                        break;
                    case "edit":
                        //method
                        break;
                    default : throw new Exception ("La demande n'est pas valide, vérifiez l'url");
                }
                break;
            case "image":
                print_r(getPictureName($_POST["Name"], $_FILES["Link"]));
                break;
            default : throw new Exception ("La demande n'est pas valide, vérifiez l'url");
        }
    } else {
        throw new Exception ("Problème de récupération de données.");
    }
} catch(Exception $e){
    $erreur =[
        "message" => $e->getMessage(),
        "code" => $e->getCode()
    ];
}