<?php require_once "../components/header.php" ?>
<?php require_once "../../Models/AdminModels.php"; ?>
<?php require_once "../../Controllers/ControleurFootballeurs.php" ?>

<?php
    $Footballeurs = new ControleurFootballeurs();
    $footballeurs = $Footballeurs->getFootballeurs();
?>

<div class="container mx-auto my-5" id="test"></div>
<div class="container mx-auto row" id="container">
    <?php
        foreach($footballeurs->{'records'} as $footballeur){
            ?>
                <div class="col-sm-3">
                    <a href="profil.php?ftb=<?= $footballeur->{'fields'}->{'Nom'} ?>" title="<?= $footballeur->{'fields'}->{'Nom'} ?>">
                        <img src="../../Assets/src/<?=$footballeur->{'fields'}->{'Link'}?>" class="card-img-top">
                    </a>
                </div>
            <?php
        }
    ?>
    <div class="col-sm-3 d-flex justify-content-center flex-column align-items-center">
        <a id="btn-i" class="btn" href="add.php">
            <i id="add-i" class="bi bi-plus-square"></i>
        </a>
    </div>
</div>

<script>
    // const userAction = async () => {
    //     const response = await fetch('../../Api/apiway.php?table=footballeurs&method=get');
    //     const myJson = await response.json();
    //     var records = myJson.records;

    //     var container = document.getElementById("container");


    //     records.forEach(function(item){
    //         console.log(item);
            
    //         let div = document.createElement("div");
    //         div.className = "col-sm-3";

    //         let a = document.createElement("a");
    //         a.href = "profil.php?ftb="+item.fields.Nom;
    //         a.title = item.fields.Nom ;

    //         let img = document.createElement("img");
    //         img.src = "../../Assets/src/"+item.fields.Link;
    //         img.className = "card-img-top";
            
    //         a.appendChild(img);  
    //         div.appendChild(a);  
    //         container.appendChild(div);  

    //     });

    //     let div = document.createElement("div");
    //     div.className = "col-sm-3 d-flex justify-content-center flex-column align-items-center";

    //     let a = document.createElement("a");
    //     a.id = "btn-i";
    //     a.className = "btn";
    //     a.href = "add.php";

    //     let i = document.createElement("i");
    //     i.id = "add-i";
    //     i.className = "bi bi-plus-square";

    //     a.appendChild(i);  
    //     div.appendChild(a);  
    //     container.appendChild(div);  
    // }
    // userAction();
</script>

<script>
    window.addEventListener('load', function () {
        if(localStorage.getItem('delete') != undefined){
            if(localStorage.getItem('delete') == "ok"){
                toastr.success('Le footballeur a bien ??t?? supprim??');
            }else if(localStorage.getItem('delete') == "error"){
                toastr.danger("Un probl??me est survenu lors de la suppression");
            }
        }
        localStorage.clear();
    })
</script>

<?php require_once "../components/footer.php" ?>