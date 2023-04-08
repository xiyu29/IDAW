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
                <p class="post-meta" id="nomProfil"></p>
            </div>
            <!-- divide-->
            <div class="post-preview">
                <h4 class="post-subtitle">Prenom</h4>
                <p class="post-meta" id="prenomProfil"></p>
            </div>
            <!-- divide-->
            <div class="post-preview">
                <h4 class="post-subtitle">Niveau de sport</h4>
                <p class="post-meta" id="sportProfil"></p>
            </div>
            <!-- divide-->
            <div class="post-preview">
                <h4 class="post-subtitle">Age</h4>
                <p class="post-meta" id="ageProfil"></p>
            </div>
            <!-- divide-->
            <div class="post-preview">
                <h4 class="post-subtitle">Sexe</h4>
                <p class="post-meta" id="sexeProfil"></p>
            </div>
            <!-- divide-->
            <div class="post-preview">
                <h4 class="post-subtitle">Taille/m</h4>
                <p class="post-meta" id="tailleProfil"></p>
            </div>
            <!-- divide-->
            <div class="post-preview">
                <h4 class="post-subtitle">Poids/kg</h4>
                <p class="post-meta" id="poidsProfil"></p>
            </div>
            <!-- divide-->
            <div class="post-preview">
                <h4 class="post-subtitle">Email</h4>
                <p class="post-meta" id="emailProfil"></p>
            </div>
            <div class="d-flex justify-content-end mb-4">
                <a class="btn btn-primary text-uppercase" href="http://localhost/Projet_Antoine_Xi/frontend/modificationProfil.php">Modifier mon profil</a>
                <div style="width: 25px;"></div>
                <a class="btn btn-primary text-uppercase" href="http://localhost/Projet_Antoine_Xi/frontend/modificationMdp.php">Modifier mon mot de passe</a>
            </div>
        </div>
    </div>
</div>

<?php

    require_once('template_foot.php');

?>

<script>
    showProfil();
</script>
