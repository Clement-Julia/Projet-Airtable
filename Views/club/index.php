<?php require_once "../components/header.php" ?>
<div class="container mt-3">
    <table class="table table-bordered text-light">
    <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Pays</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($footballeurs->{'records'} as $value){
                ?>
                    <tr>
                        <td><?= $value->{'fields'}->{'Nom'} ?></th>
                        <td><?= reset($value->{'fields'}->{'Pays'}) ?></td>
                    </tr>
                <?php
            }
        ?>
    </tbody>
    </table>
</div>

<script>
    const userAction = async () => {
        const response = await fetch('../../Api/apiway.php?table=club&method=get');
        const myJson = await response.json();
        var records = myJson.records;

        var container = document.getElementById("container");


        records.forEach(function(item){
            console.log(item);
            
            let div = document.createElement("div");
            div.className = "col-sm-3";

            let a = document.createElement("a");
            a.href = "profil.php?ftb="+item.fields.Nom;

            let img = document.createElement("img");
            img.src = "../../Assets/src/"+item.fields.Link;
            img.className = "card-img-top";
            
            a.appendChild(img);  
            div.appendChild(a);  
            container.appendChild(div);  

        });

        let div = document.createElement("div");
        div.className = "col-sm-3 d-flex justify-content-center flex-column align-items-center";

        let a = document.createElement("a");
        a.className = "btn btn-secondary btn-outline";
        a.href = "add.php";

        let i = document.createElement("i");
        i.className = "bi bi-plus-square";

        a.appendChild(i);  
        div.appendChild(a);  
        container.appendChild(div);  
    }
    userAction();
</script>

<?php require_once "../components/footer.php" ?>