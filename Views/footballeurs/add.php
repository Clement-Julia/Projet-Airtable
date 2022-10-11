<?php require_once "../components/header.php" ?>

<div class="container my-3">
    <form class="row g-3 needs-validation" method="post" action="../../Api/apiway.php?table=footballeurs&method=add" enctype="multipart/form-data" novalidate>
    <div class="col-md-4">
        <label for="validationCustom01" class="form-label">Nom</label>
        <input type="text" class="form-control" id="validationCustom01" name="Nom" required>
        <div class="valid-feedback">
            Ok!
        </div>
        <div class="invalid-feedback">
            Veuillez renseignez ce champ
        </div>
    </div>
    <div class="col-md-4">
        <label for="validationCustom02" class="form-label">Prénom</label>
        <input type="text" class="form-control" id="validationCustom02" name="Prenom" required>
        <div class="valid-feedback">
            Ok!
        </div>
        <div class="invalid-feedback">
            Veuillez renseignez ce champ
        </div>
    </div>
    <div class="col-md-3">
        <label for="validationCustomPhoto" class="form-label">Photo</label>
        <input type="file" name="Link" class="form-control" id="validationCustomPhoto" aria-label="file example" required>
        <div class="invalid-feedback">Choisissez une photo correcte</div>
    </div>
    <div class="col-md-3">
        <label for="validationCustom04" class="form-label">Club</label>
        <select class="form-select" id="clubID" name="Club[]">
        <option selected disabled value="">Choisissez un club...</option>
        </select>
    </div>
    <div class="col-md-3">
        <label for="validationCustom04" class="form-label">Championnat</label>
        <select class="form-select" id="champID" name="Championnat[]">
        <option selected disabled value="">Choisissez un championnat...</option>
        </select>
    </div>
    <div class="col-md-3">
        <label for="validationCustom04" class="form-label">Palmarès</label>
        <select class="form-select" id="palmaresID" name="Palmares[]" multiple>
        <option selected disabled value="">Sélectionner des trophées...</option>
        </select>
    </div>
    <div class="col-12">
        <button class="btn btn-primary" type="submit">Ajouter</button>
    </div>
    </form>
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
</script>

<?php require_once "../components/footer.php" ?>