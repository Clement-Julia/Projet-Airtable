<?php require_once "../components/header.php" ?>

<div class="container row my-3 mx-auto text-left d-flex flex-column align-items-center">
    <div class="col-md-5 my-2">
        <label for="Nom" class="form-label">Nom</label>
        <input type="text" class="form-control" id="Nom" name="Nom" required>
        <div class="valid-feedback">
            Ok!
        </div>
        <div class="invalid-feedback">
            Veuillez renseignez ce champ
        </div>
    </div>
    <div class="col-md-5 my-2">
        <label for="Prenom" class="form-label">Prénom</label>
        <input type="text" class="form-control" id="Prenom" name="Prenom" required>
        <div class="valid-feedback">
            Ok!
        </div>
        <div class="invalid-feedback">
            Veuillez renseignez ce champ
        </div>
    </div>
    <div class="col-md-5 my-2">
        <label for="validationCustomPhoto" class="form-label">Photo</label>
        <input type="file" name="Link" class="form-control" id="validationCustomPhoto" aria-label="file example" required>
        <div class="invalid-feedback">Choisissez une photo correcte</div>
    </div>
    <div class="col-md-5 my-2">
        <label for="clubID" class="form-label">Club</label>
        <select class="form-select" id="clubID" name="Club[]">
        <option selected disabled value="">Choisissez un club...</option>
        </select>
    </div>
    <div class="col-md-5 my-2">
        <label for="champID" class="form-label">Championnat</label>
        <select class="form-select" id="champID" name="Championnat[]">
        <option selected disabled value="">Choisissez un championnat...</option>
        </select>
    </div>
    <div class="col-md-5 my-2">
        <label for="palmaresID" class="form-label">Palmarès</label>
        <select class="form-select" id="palmaresID" name="Palmares[]" multiple>
        </select>
    </div>
    <div class="col-md-5 my-2 d-flex justify-content-center">
        <button class="btn btn-primary" type="submit" onclick="addFootballeurs()">Ajouter</button>
    </div>
</div>

<script>
    // Form validation js
    (() => {
        'use strict'
        const forms = document.querySelectorAll('.needs-validation')

        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
            }, false)
        })
    })();

    // CLub api
    const Club = async () => {
        const response = await fetch('../../Api/apiway.php?table=club&method=get');
        const myJson = await response.json();
        var records = myJson.records;

        var select = document.getElementById("clubID");

        records.forEach(function(item){
            let opt = document.createElement("option");
            opt.value = item.id;
            opt.innerHTML = item.fields.Nom;
            
            select.appendChild(opt);

        });
    }
    Club();

    // Championnat api
    const champ = async () => {
        const response = await fetch('../../Api/apiway.php?table=championnats&method=get');
        const myJson = await response.json();
        var records = myJson.records;

        var select = document.getElementById("champID");

        records.forEach(function(item){
            let opt = document.createElement("option");
            opt.value = item.id;
            opt.innerHTML = item.fields.Nom;
            
            select.appendChild(opt);

        });
    }
    champ();

    // Palmares api
    const Palmares = async () => {
        const response = await fetch('../../Api/apiway.php?table=palmares&method=get');
        const myJson = await response.json();
        var records = myJson.records;

        var select = document.getElementById("palmaresID");

        records.forEach(function(item){
            let opt = document.createElement("option");
            opt.value = item.id;
            opt.innerHTML = item.fields.Nom;
            
            select.appendChild(opt);
        }); 
    }
    Palmares();

    function addFootballeurs() {
        if(document.getElementById("Nom").value == (undefined || "") || document.getElementById("Prenom").value == (undefined || "")){
            alert("Le footballeur doit avoir au minimum : un nom, un prénom et une image");
        }else{
            var file = document.querySelector('#validationCustomPhoto').files[0];
            if(file != undefined){
                var link = upload(document.getElementById("Nom").value, file);
                if(link != undefined || link != "error"){
                    var palmares = document.querySelectorAll('#palmaresID option:checked');
                    palmaresID = [];
                    palmares.forEach(item => {
                        if(item.value != ""){
                            palmaresID.push(item.value);
                        }
                    });
            
                    var data = {
                        'fields': {
                            'Nom': document.getElementById("Nom").value,
                            'Prenom': document.getElementById("Prenom").value,
                            'Link': link,
                            'clubID': [document.getElementById("clubID").value],
                            'championnatsID': [document.getElementById("champID").value],
                            'palmaresID': palmaresID
                        }
                    }
            
                    getApi(data, 'POST');
                    location.assign("profil.php?ftb="+document.getElementById("Nom").value);
                }else{
                    alert("Le format est incorrect");
                }
            }else{
                alert("Une image est obligatoire");
            }
        }
    }
</script>

<?php require_once "../components/footer.php" ?>