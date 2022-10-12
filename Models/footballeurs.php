<?php

class Footballeurs extends AdminModels {
    private $nom;
    private $prenom;
    private $club;
    private $link;
    private $championnat;
    private $palmares;

    public function __construct($idFootballeur = null) {
        if($idFootballeur){
            // $this->var = $var;
        }
    }

    // Footballeurs
    function getFootballeurs($name = null)
    {
        $curl = curl_init();
        if($name){
            curl_setopt($curl, CURLOPT_URL, "https://api.airtable.com/v0/appU8XVKTu0MyvbZY/footballeurs?filterByFormula=Nom%3D%22".$name."%22&view=view");
        }else{
            curl_setopt($curl, CURLOPT_URL, "https://api.airtable.com/v0/appU8XVKTu0MyvbZY/footballeurs?view=view");
        }
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

    function getFootballeursJSON($name = null)
    {
        $curl = curl_init();
        if($name){
            curl_setopt($curl, CURLOPT_URL, "https://api.airtable.com/v0/appU8XVKTu0MyvbZY/footballeurs?filterByFormula=Nom%3D%22".$name."%22&view=view");
        }else{
            curl_setopt($curl, CURLOPT_URL, "https://api.airtable.com/v0/appU8XVKTu0MyvbZY/footballeurs?view=view");
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

        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');

        curl_close($curl);

        return $resultat;
    }

    function addFootballeurs($data = null, $link)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, "https://api.airtable.com/v0/appU8XVKTu0MyvbZY/footballeurs");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $auth = "Authorization: Bearer keyCJAnKSTSgRGION";
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json', $auth
        ]);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');

        $newName = $data["Nom"];
        $ext = substr($link["name"], strrpos($link["name"], '.'));
        $target_dir = "../Assets/src/";
        $target_file = $target_dir . $newName . $ext;
        move_uploaded_file($link["tmp_name"], $target_file);
        chmod($target_file, 0777);
        $data["Link"] = $newName.$ext;

        $data = [
            'records' => [
                [
                    'fields' => $data
                ]
            ]
        ];
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

        $resultat = curl_exec($curl);
        if ($resultat === (false || null)) {
            throw new Exception(curl_error($curl), curl_errno($curl));
        }
        curl_close($curl);

        return $resultat;
    }

    function updateFootballeurs($id, $data = null, $link = null)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, "https://api.airtable.com/v0/appU8XVKTu0MyvbZY/footballeurs");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $auth = "Authorization: Bearer keyCJAnKSTSgRGION";
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json', $auth
        ]);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');

        if($link){
            $newName = $data["Nom"];
            $ext = substr($link["name"], strrpos($link["name"], '.'));
            $target_dir = "../Assets/src/";
            $target_file = $target_dir . $newName . $ext;
            move_uploaded_file($link["tmp_name"], $target_file);
            chmod($target_file, 0777);
            $data["Link"] = $newName.$ext;
        }

        $data = [
            'records' => [
                [
                    'id' => $id,
                    'fields' => $data
                ]
            ]
        ];
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));

        $resultat = curl_exec($curl);
        if ($resultat === (false || null)) {
            throw new Exception(curl_error($curl), curl_errno($curl));
        }
        curl_close($curl);

        return $resultat;
    }

    // Clubs
    function getClubs()
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
        $resultat = json_decode($resultat);

        return $resultat;
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

    // Pays
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

    // Championnats
    function getChampionnats()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://api.airtable.com/v0/appU8XVKTu0MyvbZY/championnats?view=view");
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

    function getChampionnatsJSON()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://api.airtable.com/v0/appU8XVKTu0MyvbZY/championnats?view=view");
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
        $resultat = json_encode($resultat);

        return $resultat;
    }

    // Palmares
    function getPalmares()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://api.airtable.com/v0/appU8XVKTu0MyvbZY/palmares?view=view");
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

    function getPalmaresJSON()
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://api.airtable.com/v0/appU8XVKTu0MyvbZY/palmares?view=view");
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
        $resultat = json_encode($resultat);

        return $resultat;
    }

    function getPictureName($name, $link){
        $newName = $name;
        $ext = substr($link["name"], strrpos($link["name"], '.'));
        $target_dir = "../Assets/src/";
        $target_file = $target_dir . $newName . $ext;
        move_uploaded_file($link["tmp_name"], $target_file);
        chmod($target_file, 0777);
        $link = $newName.$ext;

        return json_encode($link);
    }
}

?>