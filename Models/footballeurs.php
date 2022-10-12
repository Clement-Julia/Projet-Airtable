<?php

class Footballeurs extends AdminModels {
    private $nom;
    private $prenom;
    private $club;
    private $link;
    private $championnat;
    private $palmares;

    // public function __construct($idFootballeur = null) {
    //     if($idFootballeur){
    //         $this->nom = $nom;
    //         $this->prenom = $prenom;
    //         $this->club = $club;
    //         $this->championnat = $championnat;
    //         $this->palmares = $palmares;
    //     }
    // }

    function getFootballeursJSON($name = null)
    {
        return $this->InitCurl('footballeurs', $name);
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


    // Non utilisé
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
}

?>