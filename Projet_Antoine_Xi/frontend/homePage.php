<?php

    require_once('template_head.php');
    require_once('template_menu.php');
?>

<!-- Header -->
<header class="masthead" style="background-image: url('assets/img/legumes2.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h2 id="userSession"></h2>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Body -->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <!-- Post preview-->
            <h3>Mes repas</h3>
            <table id="tableRepas" data-pagecount="3">
                <thead align="center">
                    <tr class="table-head">
                        <td width="150px">Date</td>
                        <td width="400px">Nourriture</td>
                        <td width="150px">Quantité/g</td>
                        <td width="150px">Energie/kj</td>
                    </tr>    
                </thead>
                <tbody  align="center" id="nourritureBody"></tbody>
            </table>
            <hr class="my-4" />

            <h3>Energie de mes derniers repas</h3>
            <canvas id="myCalorie"></canvas>
            <hr class="my-4" />
            <!-- Pager-->
            <!-- <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="journal.php">Plus repas →</a></div> -->
            <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="http://localhost/Projet_Antoine_Xi/frontend/ajoutRepas.php">Ajouter un repas →</a></div>
        </div>
    </div>
</div>

<?php

    require_once('template_foot.php');

?>

<script>
    getSession();
    showAllRepas();

    $(document).ready(function() {
        $('#tableRepas').DataTable({
            "pageLength": 5,
            "lengthChange": false,
            "order": [[0, "desc"]],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.25/i18n/French.json"
            }
            // "dom": 'lrtip'
        });
    });
    
</script>
