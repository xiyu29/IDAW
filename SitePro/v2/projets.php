<?php
require_once('template_header.php');
?>

        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
            <div class="container px-4 px-lg-5">
                <a class="navbar-brand" href="index.php">Home page</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="index.php">Home page</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="cv.php">CV</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="projets.php">Projets</a></li>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="contact.php">Contact</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page Header-->
        <header class="masthead" style="background-image: url('assets/img/post-bg.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="post-heading">
                            <h1>My projets</h1>
                            <h2 class="subheading">In my four-year's time in IMT</h2>
                            <span class="meta">
                                Posted by
                                <a href="index.php">Xi</a>
                                on March 13, 2023
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Post Content-->
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <h2 class="section-heading">Transformation numérique</h2>
                        <blockquote class="blockquote">novembre 2022 - décembre 2022</blockquote>
                        <p>Recherche sur l'impact de la transformation numérique sur les entreprises</p>
                        <p>Recherche sur les nouveaux objets connectés</p>
                        <p>Recherche sur les avantage-inconvénient sur la transformation numérique</p>
                        <h2 class="section-heading">Runout</h2>
                        <blockquote class="blockquote">octobre 2021 - avril 2022</blockquote>
                        <p>Jeu de société sur le réchauffement climatique</p>
                        <p>Collaboration avec un lycée douaisis</p>    
                    </div>
                </div>
            </div>
        </article>
        <!-- Footer-->

<?php
require_once('template_foot.php');
?>