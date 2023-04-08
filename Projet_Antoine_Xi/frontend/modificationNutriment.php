<?php
    require_once('template_head.php');
    //require_once('template_menu.php');
?>

<?php
  $id = $_GET['id'];
?>

<!-- Header class -->
<header class="masthead" style="background-image: url('assets/img/legumes.jpeg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <div class="site-heading">
                    <h2>Modification aliment</h2>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- body -->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <span class="subheading">
                <table id="modificationAliment" class="table">
                </table>
                <div style="float:right;">
                    <a onclick="" class="btn btn-primary" href="http://localhost/Projet_Antoine_Xi/frontend/showAliment.php">Renevir</a>
                    <button onclick="modifierNutriment(<?php echo $id; ?>)" class="btn btn-primary">Modifier</button>
                </div>    
            </span>
        </div>
    </div>
</div>

<?php
    require_once('template_foot.php');
?>

<script>

    window.onload = function() {
        initialiserTextArea(<?php echo $id; ?>);
    }

</script>