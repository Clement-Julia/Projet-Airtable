<?php

class Club extends AdminModels {
    private $nom;
    private $pays;

    public function __construct($var = null) {
        $this->var = $var;
    }

    function getClubsJSON()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://api.airtable.com/v0/appU8XVKTu0MyvbZY/club?view=view");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $auth = "Authorization: Bearer keyCJAnKSTSgRGION";
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/json' => $auth]);

        $resultat = curl_exec($curl);
        if ($resultat === (false || null)) {
            throw new Exception(curl_error($curl), curl_errno($curl));
        }

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');

        curl_close($curl);
        if ($resultat === (false || null)) {
            throw new Exception(curl_error($curl), curl_errno($curl));
        }
        $resultat = json_decode($resultat);
        $resultat = json_encode($resultat);

        return $resultat;
    }
}