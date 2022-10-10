<?php require_once "../components/header.php" ?>
<?php require_once "../../Api/footballeurs.php" ?>

<?php
    $footballeurs = getClubs();
?>

<div class="container mt-3">
    <table class="table table-bordered">
    <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Footballeur(s)</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($footballeurs->{'records'} as $value){
                ?>
                    <tr>
                        <td><?= $value->{'fields'}->{'Nom'} ?></th>
                        <td>
                        <?php
                            $lastElement = end($value->{'fields'}->{'footballers'});
                            foreach($value->{'fields'}->{'footballers'} as $footballeur){
                                if($footballeur == $lastElement){
                                    echo $footballeur;
                                }else{
                                    echo $footballeur.", ";
                                }
                            }
                        ?>
                        </td>
                    </tr>
                <?php
            }
        ?>
    </tbody>
    </table>
</div>

<?php require_once "../components/footer.php" ?>