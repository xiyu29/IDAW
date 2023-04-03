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
<!-- <div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7"> -->
            <!-- Post preview-->
            <!-- <h3>Mes 5 derniers repas</h3>
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
            <hr class="my-4" /> -->
            <!-- Pager-->
            <!-- <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="post.html">Plus repas →</a></div> -->
        <!-- </div>
    </div>
</div> -->

<!-- show all nourriture -->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <!-- Post preview-->
            <table id="tableAllNourriture">
                <thead align="center">
                    <tr class="table-head">
                        <th width="100px">Id</th>
                        <th width="800px">Nourriture</th>
                        <th width="600px">Type</th>
                        <th width="150px">*modifier*</th>
                        <th width="150px">*supprimer*</th>
                    </tr>    
                </thead>
                <tbody  align="center" id="allNourritureBody"></tbody>
            </table>
            <hr class="my-4" />
            <!-- Pager-->
        </div>
    </div>
</div>

<!-- ajout d'un nouveau nourriture -->
<form id="addPersonForm" action="" onsubmit="onFormSubmit();">
    <div class="form-group row">
        <label for="inputNom" class="col-sm-2 col-form-label">Nom Aliment*</label>
        <div class="col-sm-3">
            <input type="text" required="true" class="form-control" id="inputNom">
        </div>
    </div>
    <div class="form-group row">
        <label for="inputType" class="col-sm-2 col-form-label">Type </label>
        <div class="col-sm-3">
            <input type="text" required="true" class="form-control" id="inputType">
        </div>
        <div class="form-group row">
            <span class="col-sm-2"></span>
            <div class="col-sm-2">
                <button type="submit" class="btn btn-primary form-control">Submit</button>
            </div>
        </div>
</form>

<script>
    showAllNourriture();
</script>

<?php

    require_once('template_foot.php');

?>