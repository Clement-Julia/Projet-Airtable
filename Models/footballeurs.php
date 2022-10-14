<?php

class Footballeurs extends AdminModels {

    public function getFootballeursJSON($name = null)
    {
        return $this->InitCurl('footballeurs', $name);
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