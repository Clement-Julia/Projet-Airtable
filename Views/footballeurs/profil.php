<?php require_once "../components/header.php" ?>
<?php require_once "../../Api/footballeurs.php" ?>

<?php
    $footballeurs = getFootballeurs($_GET["ftb"]);
    // echo "<pre>";
    // print_r($footballeurs);
    // echo "</pre>";
?>

<style>
    html{
        height: 100%;
    }
    body{
        height: 100%;
        background: center / cover no-repeat url('../../Assets/src/background-profil.jpg');
        background-attachment: fixed;
        backdrop-filter: blur(10px);
    }
    .bg-light{
        background: rgb(0 0 0 / 21%) !important;
    }

    a{
        color: rgb(233 233 233) !important;
    }
</style>

<div class="container mt-3 row align-items-center" style="max-width:100%;">
<?php
    foreach($footballeurs->{'records'} as $value){
        ?>
            <div class="col-4">
                <img src="../../Assets/src/<?= $value->{'fields'}->{'Link'}?>" class="card-img-top" alt="<?= $value->{'fields'}->{'Nom'}?>">
            </div>
            <div class="col-8" id="home">
                <table class="table table-bordered table-striped" style="background-color: rgb(255 255 255 / 40%);">
                    <tr>
                        <td>Nom</td>
                        <td><?= $value->{'fields'}->{'Nom'}?></td>
                    </tr>
                    <tr>
                        <td>Prénom</td>
                        <td><?= $value->{'fields'}->{'Prenom'}?></td>
                    </tr>
                    <tr>
                        <td>Club actuel</td>
                        <td><?= reset($value->{'fields'}->{'Club'})?></td>
                    </tr>
                    <tr>
                        <td>Championnat</td>
                        <td><?= reset($value->{'fields'}->{'Championnat'})?></td>
                    </tr>
                    <tr>
                        <td>Pays</td>
                        <td><?= reset($value->{'fields'}->{'Pays'})?></td>
                    </tr>
                    <tr>
                        <td>Palmarès</td>
                        <td>
                            <?php
                                $lastElement = end($value->{'fields'}->{'Palmares'});
                                foreach($value->{'fields'}->{'Palmares'} as $palmares){
                                    if($palmares == $lastElement){
                                        echo $palmares;
                                    }else{
                                        echo $palmares.", ";
                                    }
                                }
                            ?>
                            <!-- <?= reset($value->{'fields'}->{'Pays'})?> -->
                        </td>
                    </tr>
                </table>
                <!-- <p>Club actuel : <?= reset($value->{'fields'}->{'Club'})?></p>
                <p>Championnat : <?= reset($value->{'fields'}->{'Championnat'})?></p>
                <p>Pays : <?= reset($value->{'fields'}->{'Pays'})?></p>
            </div> -->
        <?php
    }
?>
</div>

<?php require_once "../components/footer.php" ?>