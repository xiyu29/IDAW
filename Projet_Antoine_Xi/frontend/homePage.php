<?php

    require_once('template_head.php');
    require_once('template_menu.php');
    
?>

<!-- Header -->
<header class="masthead" style="background-image: url('assets/img/legumes2.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading" id="userSession"></div>
            </div>
        </div>
    </div>
</header>

<!-- Body -->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <!-- Post preview-->
            <h3>Mes 5 derniers repas</h3>
            <table>
                <thead align="center">
                    <tr>
                        <td width="150px">Date</td>
                        <td width="400px">Nourriture</td>
                        <td width="150px">Quantité</td>
                    </tr>    
                </thead>
                <tbody  align="center" id="nourritureBody"></tbody>
            </table>
            <hr class="my-4" />
            <!-- Pager-->
            <div class="d-flex justify-content-end mb-4"><button onclick="showRepas()">Show</button></div>
            <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="post.html">Plus repas →</a></div>
        </div>
    </div>
</div>

<?php

    require_once('template_foot.php');

?>

<script>

    function showRepas(){
        // alert("showRepas clicked");
        $.ajax({
            url: "http://localhost/Projet_Antoine_Xi/backend/api.php",
            method: "GET",
            data: JSON.stringify({
                userId: 1, 
                type: 'consommer',
            }),
            dataType: "json",
            success: function(data) {
                console.log(data);
                // showAll(data);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    function showAll(data){
        console.log('ok');
        length = data.length;
        for(var i = 0; i < length; i ++){
            let id = data[i].Id_personne;
            let nom = data[i].Nom_personne;
            let prenom = data[i].Prenom_personne;
            $("#nourritureBody").append(`
                <tr align="center">
                    <td>${id}</td>
                    <td>${nom}</td>
                    <td>${prenom}</td>
                </tr>
            `);
        }
    }

</script>

<script>
    getSession();
</script>
