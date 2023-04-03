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
                    <h2 id="titreProfil"></h2>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Body -->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <!-- divide-->
            <div class="post-preview">
                <h4 class="post-subtitle">Nom</h4>
                <div id="inputNom"></div>   
            </div>
            <!-- divide-->
            <div class="post-preview">
                <h4 class="post-subtitle">Prenom</h4>
                <div id="inputPrenom"></div>  
            </div>
            <!-- divide-->
            <div class="post-preview">
                <h4 class="post-subtitle">Niveau de sport</h4>
                <div id="inputSport" class="selectStyle"></div>  
            </div>
            <!-- divide-->
            <div class="post-preview">
                <h4 class="post-subtitle">Age</h4>
                <div id="inputAge" class="selectStyle"></div>  
            </div>
            <!-- divide-->
            <div class="post-preview">
                <h4 class="post-subtitle">Sexe</h4>
                <div id="inputSexe" class="selectStyle"></div>  
            </div>
            <!-- divide-->
            <div class="post-preview">
                <h4 class="post-subtitle">Taille/m</h4>
                <div id="inputTaille"></div>  
            </div>
            <!-- divide-->
            <div class="post-preview">
                <h4 class="post-subtitle">Poids/kg</h4>
                <div id="inputPoids"></div>  
            </div>
            <!-- divide-->
            <div class="post-preview">
                <h4 class="post-subtitle">Email</h4>
                <div id="inputEmail"></div>  
            </div>
            <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase">Confirmer</a></div>
        </div>
    </div>
</div>

<?php

    require_once('template_foot.php');

?>

<script>
    inputProfil();

    $(document).ready(function() {
        $(".btn-primary").on("click", function() {
            confirmModification();
        });
    });
</script>
