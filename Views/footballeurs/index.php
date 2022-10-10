<?php require_once "../components/header.php" ?>
<?php require_once "../../Api/footballeurs.php" ?>

<?php
    $footballeurs = getFootballeurs();
?>
<style>
    #test{
        background-image: url('../../Assets/src/background-index.jpg');
        min-height: 650px;
        max-width: 100%;
        background-repeat: no-repeat;
        background-position: center;
    }
</style>
<div class="container mx-auto" id="test">

</div>
<div class="container mt-3 mx-auto row">
    <?php
        foreach($footballeurs->{'records'} as $value){
            ?>
            <div class="col-sm-3">
                <a href="profil.php?ftb=<?= $value->{'fields'}->{'Nom'}?>"><img src="../../Assets/src/<?= $value->{'fields'}->{'Link'}?>" class="card-img-top" alt="<?= $value->{'fields'}->{'Nom'}?>"></a>
            </div>
            <?php
        }
    ?>
</div>

<?php require_once "../components/footer.php" ?>