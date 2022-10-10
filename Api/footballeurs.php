<?php

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

function addFootballeurs($data)
{
    // $data = array(
    //     "fields" => array(
    //         "Name" => "Hello world"
    //     )
    // );
    // $data_json = json_encode($data);

    // $ch = curl_init("https://api.airtable.com/v0/appU8XVKTu0MyvbZY/footballeurs?api_key=keyCJAnKSTSgRGION");
    $ch = curl_init("https://api.airtable.com/v0/appU8XVKTu0MyvbZY/footballeurs");
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json' => "Authorization: Bearer keyCJAnKSTSgRGION"
    ));

    $result = curl_exec($ch);
    return $result;
}
?>