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
                    <h2>Mes aliments</h2>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Body -->
<!-- show all aliment -->
<table id="tableAliments" align="center">
    <thead align="center">
        <tr class="table-head">
            <td>Id</td>
            <td>Type d'aliment</td>
            <td>Nom d'aliment</td>
            <td></td>
            <td></td>
            <td></td>
        </tr>    
    </thead>
    <tbody  align="center" id="alimentsBody"></tbody>
</table>

<!-- Ajout d'un aliment -->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7" align="center">
            <span class="subheading">
            <h3>Ajouter un aliment</h3>
                <form>
                    <table>
                        <tr>
                            <td>
                                <label>Nom</label>
                            </td>
                            <td>
                                <input type="text" id="nom" class="inputText">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Type</label>
                            </td>
                            <td>
                                <select name="type" id="type" class="selectStyle">
                            </td>
                        </tr>
                        <tr>
                            <td>
                            </td>
                            <td align="right" id="buttonArea">
                                <button onclick="addAliment()" class="btn btn-primary" id="submit">Ajouter</button>
                            </td>
                        </tr>
                    </table>
                </form>
            </span>
        </div>
    </div>
</div>

<?php

    require_once('template_foot.php');

?>

<script>

    getAllAliments();

    getAllType();
    
</script>
