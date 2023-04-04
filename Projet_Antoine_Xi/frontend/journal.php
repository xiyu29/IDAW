<?php

    require_once('template_head.php');
    require_once('template_menu.php');
    
?>
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <!-- Post preview-->
            <h3>Journal :</h3>
            <table>
                <thead align="center">
                    <tr class="table-head">
                        <td width="150px">Date</td>
                        <td width="400px">Nourriture</td>
                        <td width="150px">Quantité/g</td>
                    </tr>    
                </thead>
                <tbody  align="center" id="nourritureBody"></tbody>
            </table>
            <hr class="my-4" />
            <!-- Pager-->
            <button onclick="ajoutRepas()" class="btn btn-primary" id="newRepas">Ajouter un repas</button>
        </div>
    </div>
</div>
<?php

    require_once('template_foot.php');

?>
<script>
    getSession();
    showMeal();
</script>
