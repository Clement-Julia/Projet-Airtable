<?php

class Pays extends AdminModels {
    private $nom;

    public function __construct($var = null) {
        $this->var = $var;
    }
    
    function getPays()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://api.airtable.com/v0/appU8XVKTu0MyvbZY/pays?view=view");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $auth = "Authorization: Bearer keyCJAnKSTSgRGION";
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json' => $auth]);

        $resultat = curl_exec($curl);
        if ($resultat === (false || null)) {
            throw new Exception(curl_error($curl), curl_errno($curl));
        }

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');

        curl_close($curl);
        $resultat = json_decode($resultat);

        return $resultat;
    }
}