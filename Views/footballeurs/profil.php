<?php require_once "../components/header.php" ?>
<?php require_once "../../Models/AdminModels.php" ?>
<?php require_once "../../Models/Footballeurs.php" ?>

<?php
    $Footballeurs = new Footballeurs();
    $footballeurs = json_decode($Footballeurs->getFootballeursJSON($_GET["ftb"]));
?>


<style>
    body{
    height: 100%;
    background: center / cover no-repeat url('../../Assets/src/background-profil.jpg');
    background-attachment: fixed;
    backdrop-filter: blur(10px);
}
</style>


<?php
    foreach($footballeurs->{'records'} as $footballeur){
        ?>
        <div class="container mt-3 row align-items-center" style="max-width:100%;">
            <div class="col-md-12 d-flex justify-content-end">
                <a id="edit" href="edit.php?ftb=<?=$footballeur->{'fields'}->{'Nom'}?>"><i class="bi bi-pencil-square fa-xs"></i></a>
            </div>
            <div class="col-4">
                <img id="picture" src="../../Assets/src/<?=$footballeur->{'fields'}->{'Link'}?>" class="card-img-top" alt="<?= $footballeur->{'fields'}->{'Nom'} ?>">
            </div>
            <div class="col-8" id="home">
                <table class="table table-bordered table-striped" style="background-color: rgb(255 255 255 / 40%);">
                    <tr>
                        <td>Nom</td>
                        <td id="Nom"><?=$footballeur->{'fields'}->{'Nom'}?></td>
                    </tr>
                    <tr>
                        <td>Prénom</td>
                        <td id="Prenom"><?=$footballeur->{'fields'}->{'Prenom'}?></td>
                    </tr>
                    <tr>
                        <td>Club actuel</td>
                        <td id="Club"><?=reset($footballeur->{'fields'}->{'Club'})?></td>
                    </tr>
                    <tr>
                        <td>Championnat</td>
                        <td id="Championnat"><?=reset($footballeur->{'fields'}->{'Championnat'})?></td>
                    </tr>
                    <tr>
                        <td>Pays</td>
                        <td id="Pays"><?=reset($footballeur->{'fields'}->{'Pays'})?></td>
                    </tr>
                    <tr>
                        <td>Palmarès</td>
                        <td id="Palmares">
                            <?php
                                $lastElement = end($footballeur->{'fields'}->{'Palmares'});
                                foreach($footballeur->{'fields'}->{'Palmares'} as $palmares){
                                    if($palmares == $lastElement){
                                        echo $palmares;
                                    }else{
                                        echo $palmares.", ";
                                    }
                                }
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    <?php
}
?>

<script>
    // window.onload=function() {
    //     const userAction = async () => {
    //         const response = await fetch('../../Api/apiway.php?table=footballeurs&method=get&name=<?= $_GET['ftb'] ?>');
    //         const myJson = await response.json();
    //         var records = myJson.records;

    //         records.forEach(function(item){
    //             console.log(item);

    //             document.getElementById("picture").src = "../../Assets/src/"+item.fields.Link ;
    //             document.getElementById("picture").alt = item.fields.Nom ;
                
    //             document.getElementById("edit").href = "edit.php?ftb="+item.fields.Nom ;

    //             document.getElementById("Nom").innerHTML = item.fields.Nom ;
    //             document.getElementById("Prenom").innerHTML = item.fields.Prenom ;
    //             document.getElementById("Club").innerHTML = item.fields.Club[0] ;
    //             document.getElementById("Championnat").innerHTML = item.fields.Championnat[0] ;
    //             document.getElementById("Pays").innerHTML = item.fields.Pays[0] ;

    //             var palmares = item.fields.Palmares;
    //             palmares.forEach(function(element){
    //                 if(element == palmares[palmares.length-1]){
    //                     document.getElementById("Palmares").innerHTML += element;
    //                 }else{
    //                     document.getElementById("Palmares").innerHTML += element+", " ;
    //                 }

    //             });

    //         });
    //     }
    //     userAction();
    // }
</script>

<?php require_once "../components/footer.php" ?>