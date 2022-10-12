<?php

class AdminModels {

    protected function InitCurl($table, $name = null, $method = 'POST'){
        $curl = curl_init();
        if($name){
            curl_setopt($curl, CURLOPT_URL, "https://api.airtable.com/v0/appU8XVKTu0MyvbZY/".$table."?filterByFormula=Nom%3D%22".$name."%22&view=view");
        }else{
            curl_setopt($curl, CURLOPT_URL, "https://api.airtable.com/v0/appU8XVKTu0MyvbZY/".$table."?view=view");
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $auth = "Authorization: Bearer keyCJAnKSTSgRGION";
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json' => $auth]);

        $resultat = curl_exec($curl);
        if ($resultat === (false || null)) {
            throw new Exception(curl_error($curl), curl_errno($curl));
        }
        
        $resultat = json_decode($resultat);
        $resultat = json_encode($resultat);

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);

        curl_close($curl);

        return $resultat;
    }
};

require_once ("Footballeurs.php");
require_once ("Championnat.php");
require_once ("Club.php");
require_once ("Palmares.php");
require_once ("Pays.php");