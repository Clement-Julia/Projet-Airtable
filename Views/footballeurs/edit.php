<?php require_once "../components/header.php" ?>
<?php require_once "../../Models/AdminModels.php"; ?>
<?php require_once "../../Controllers/ControleurFootballeurs.php" ?>
<?php require_once "../../Controllers/ControleurClub.php" ?>
<?php require_once "../../Controllers/ControleurChampionnat.php" ?>
<?php require_once "../../Controllers/ControleurPalmares.php" ?>

<?php
    $Footballeurs = new ControleurFootballeurs();
    if(!empty($_GET["ftb"])){
        $footballeurs = $Footballeurs->getFootballeurs($_GET["ftb"]);
        if(count($footballeurs->{'records'}) == 0){
            header('Location: profil.php');
        }
    }else{
        header('Location: profil.php');
    }

    $Club = new ControleurClub();
    $clubs = $Club->getClub();

    $Championnat = new ControleurChampionnat();
    $championnats = $Championnat->getChampionnats();

    $Palmares = new ControleurPalmares();
    $palmares = $Palmares->getPalmares();
?>

<?php
    foreach($footballeurs->{'records'} as $footballeur){
        ?>
            <div class="container row my-3 mx-auto text-left d-flex flex-column align-items-center">
                <!-- <form class="row g-3 needs-validation" method="post" action="../../Api/apiway.php?table=footballeurs&method=update" enctype="multipart/form-data" novalidate> -->
                <input type="hidden" value="<?=$footballeur->{'id'}?>" name="id" id="id">
                <div class="col-md-5 my-2">
                    <label for="Nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="Nom" name="Nom" value="<?=$footballeur->{'fields'}->{'Nom'}?>" required>
                    <div class="valid-feedback">
                        Ok!
                    </div>
                    <div class="invalid-feedback">
                        Veuillez renseignez ce champ
                    </div>
                </div>
                <div class="col-md-5 my-2">
                    <label for="Prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" id="Prenom" name="Prenom" value="<?=$footballeur->{'fields'}->{'Prenom'}?>" required>
                    <div class="valid-feedback">
                        Ok!
                    </div>
                    <div class="invalid-feedback">
                        Veuillez renseignez ce champ
                    </div>
                </div>
                <div class="col-md-5 my-2">
                    <label for="validationCustomPhoto" class="form-label">Photo</label>
                    <input type="file" name="Link" class="form-control" id="validationCustomPhoto" aria-label="file example">
                    <div class="invalid-feedback">Choisissez une photo correcte</div>
                </div>
                <div class="col-md-5 my-2">
                    <label for="clubID" class="form-label">Club</label>
                    <select class="form-select" id="clubID" name="Club[]">
                        <option disabled value="">Choisissez un club...</option>
                        <?php
                            foreach($clubs->{'records'} as $club){
                                ?>
                                    <option value="<?= $club->{'id'} ?>" <?= (in_array($club->{'id'}, $footballeur->{'fields'}->{'clubID'})) ? "selected" : "" ?>><?= $club->{'fields'}->{'Nom'} ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-5 my-2">
                    <label for="champID" class="form-label">Championnat</label>
                    <select class="form-select" id="champID" name="Championnat[]">
                        <option disabled value="">Choisissez un championnat...</option>
                        <?php
                        foreach($championnats->{'records'} as $championnats){
                                ?>
                                    <option value="<?= $championnats->{'id'} ?>" <?= (in_array($championnats->{'id'}, $footballeur->{'fields'}->{'championnatsID'})) ? "selected" : "" ?>><?= $championnats->{'fields'}->{'Nom'} ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-5 row my-2 me-0">
                    <label for="palmaresID" class="form-label">Palmarès</label>
                    <select class="selectpicker col-12 pe-0" id="palmaresID" name="Palmares[]" multiple>
                        <option disabled value="">Sélectionner des trophées...</option>
                        <?php
                            foreach($palmares->{'records'} as $palmares){
                                ?>
                                    <option value="<?= $palmares->{'id'} ?>" <?= (in_array($palmares->{'id'}, $footballeur->{'fields'}->{'palmaresID'})) ? "selected" : "" ?>><?= $palmares->{'fields'}->{'Nom'} ?></option>
                                <?php
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-3 my-2 d-flex justify-content-center btn-group">
                    <button class="btn btn-warning" onclick="updateFootballeurs()">Modifier</button>
                    <button class="btn btn-danger" onclick="deleteFootballeurs()">Supprimer</button>
                </div>
                <!-- </form> -->
            </div>
        <?php
    }
?>

<script>

    // CLub api
    // const Club = async () => {
    //     const response = await fetch('../../Api/apiway.php?table=club&method=get');
    //     const myJson = await response.json();
    //     var records = myJson.records;

    //     var select = document.getElementById("clubID");

    //     records.forEach(function(item){
    //         let opt = document.createElement("option");
    //         opt.value = item.id;
    //         opt.innerHTML = item.fields.Nom;
            
    //         select.appendChild(opt);

    //     });
    // }
    // Club();

    // Championnat api
    // const champ = async () => {
    //     const response = await fetch('../../Api/apiway.php?table=championnats&method=get');
    //     const myJson = await response.json();
    //     var records = myJson.records;

    //     var select = document.getElementById("champID");

    //     records.forEach(function(item){
    //         let opt = document.createElement("option");
    //         opt.value = item.id;
    //         opt.innerHTML = item.fields.Nom;
            
    //         select.appendChild(opt);

    //     });
    // }
    // champ();

    // Palmares api
    // const Palmares = async () => {
    //     const response = await fetch('../../Api/apiway.php?table=palmares&method=get');
    //     const myJson = await response.json();
    //     var records = myJson.records;

    //     var select = document.getElementById("palmaresID");

    //     records.forEach(function(item){
    //         let opt = document.createElement("option");
    //         opt.value = item.id;
    //         opt.innerHTML = item.fields.Nom;
            
    //         select.appendChild(opt);
    //     }); 
    // }
    // Palmares();

    
    // const userAction = async () => {
    //     const response = await fetch('../../Api/apiway.php?table=footballeurs&method=get&name=<?= $_GET['ftb'] ?>');
    //     const myJson = await response.json();
    //     var records = myJson.records;

    //     records.forEach(function(item){
    //         document.getElementById("id").value = item.id ;

    //         document.getElementById("Nom").value = item.fields.Nom ;
    //         document.getElementById("Nom").innerHTML = item.fields.Nom ;

    //         document.getElementById("Prenom").value = item.fields.Prenom ;
    //         document.getElementById("Prenom").innerHTML = item.fields.Prenom ;

    //         document.getElementById("clubID").value = item.fields.clubID[0] ;
    //         document.getElementById("champID").value = item.fields.championnatsID[0] ;

    //         var select = document.getElementById('palmaresID');
    //         var palmares = item.fields.palmaresID;
    //         for (var i = 0; i < select.options.length; i++) {
    //             if(select.options[i].value != ""){
    //                 if(palmares.includes(select.options[i].value)){
    //                     select.options[i].checked = true;
    //                     select.options[i].selected = palmares.indexOf(select.options[i].value) >= 0;
    //                 }
    //             }
    //         }

    //     });
    // }
    // userAction();

    async function updateFootballeurs() {
        if(document.getElementById("Nom").value == (undefined || "") || document.getElementById("Prenom").value == (undefined || "")){
            alert("Le footballeur doit avoir au minimum : un nom, un prénom");
        }else{
            var file = document.querySelector('#validationCustomPhoto').files[0];
            if(file != undefined){
                var link = await upload(document.getElementById("Nom").value, file);
                if(link["data"] != undefined || link["data"] != "error" || link["success"] != true ){
                    var palmares = document.querySelectorAll('#palmaresID option:checked');
                    palmaresID = [];
                    palmares.forEach(item => {
                        if(item.value != ""){
                            palmaresID.push(item.value);
                        }
                    });
            
                    var data = {
                        'id': document.getElementById('id').value,
                        'fields': {
                            'Nom': document.getElementById("Nom").value,
                            'Prenom': document.getElementById("Prenom").value,
                            'Link': link["data"],
                            'clubID': [document.getElementById("clubID").value],
                            'championnatsID': [document.getElementById("champID").value],
                            'palmaresID': palmaresID
                        }
                    }
            
                    result = await getApi(data, 'PATCH');
                    localStorage.setItem('edit', result);
                    location.assign("profil.php?ftb="+document.getElementById("Nom").value);
                }else{
                    if(link["message"] != "" ){
                        alert(link["message"]);
                    }else{
                        alert("Le format est incorrect");
                    }
                }
            }else{
                var palmares = document.querySelectorAll('#palmaresID option:checked');
                palmaresID = [];
                palmares.forEach(item => {
                    if(item.value != ""){
                        palmaresID.push(item.value);
                    }
                });
        
                var data = {
                    'id': document.getElementById('id').value,
                    'fields': {
                        'Nom': document.getElementById("Nom").value,
                        'Prenom': document.getElementById("Prenom").value,
                        'clubID': [document.getElementById("clubID").value],
                        'championnatsID': [document.getElementById("champID").value],
                        'palmaresID': palmaresID
                    }
                }
        
                result = await getApi(data, 'PATCH');
                localStorage.setItem('edit', result);
                location.assign("profil.php?ftb="+document.getElementById("Nom").value);
        }
        }
    }

    async function deleteFootballeurs() {
        var ID = document.getElementById('id').value;
        var URL = `https://api.airtable.com/v0/appU8XVKTu0MyvbZY/footballeurs/${ID}`
        result = await getApi(null, 'DELETE', URL);
        localStorage.setItem('delete', result);
        location.assign("index.php");
    }
</script>

<?php require_once "../components/footer.php" ?>