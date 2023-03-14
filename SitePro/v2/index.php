<?php
    require_once('template_header.php');
?>

        <!-- Navigation-->
        <?php
            require_once('template_menu.php')
        ?>

        <!-- Page Header-->
        <header class="masthead" style="background-image: url('assets/img/home-bg.jpg')">
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <img src="assets/img/photo1.jpg" width="200px" class="img_rond">
                            <h1>Xi YU</h1>
                            <span class="subheading">Ingénieur en M1</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content-->
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <!-- Post preview-->
                    <div class="post-preview">
                        <a href="post.php">
                            <h2 class="post-title">Doc1 à ajouter</h2>
                            <h3 class="post-subtitle">Sous titre du doc1</h3>
                        </a>
                        <p class="post-meta">
                            Posted by
                            <a href="index.php">Xi</a>
                            on March 13, 2023
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                    <!-- Post preview-->
                    <div class="post-preview">
                        <a href="post.php"><h2 class="post-title">Doc2 à ajouter</h2></a>
                        <p class="post-meta">
                            Posted by
                            <a href="index.php">Xi</a>
                            on March 13, 2023
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                    <!-- Post preview-->
                    <div class="post-preview">
                        <a href="post.php">
                            <h2 class="post-title">Doc3 à ajouter</h2>
                            <h3 class="post-subtitle">Sous-titre du doc3</h3>
                        </a>
                        <p class="post-meta">
                            Posted by
                            <a href="index.php">Xi</a>
                            on March 13, 2023
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                    <!-- Post preview-->
                    <div class="post-preview">
                        <a href="post.php">
                            <h2 class="post-title">Doc4 à ajouter</h2>
                            <h3 class="post-subtitle">Sous-titre du doc3</h3>
                        </a>
                        <p class="post-meta">
                            Posted by
                            <a href="index.php">Xi</a>
                            on March 13, 2023
                        </p>
                    </div>
                    <!-- Divider-->
                    <hr class="my-4" />
                    <!-- Pager-->
                    <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="post.html">Older Posts →</a></div>
                </div>
            </div>
        </div>
        <!-- Footer-->

<?php
require_once('template_foot.php');
?>
