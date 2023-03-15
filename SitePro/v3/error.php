<?php
    require_once('template_header.php');
    // Navigation
    require_once('template_menu.php');

    $currentPageId = 'accueil';
    if(isset($_GET['page'])) {
        $currentPageId = $_GET['page'];
    }   
?>

<?php
    renderMenuToHTML('Home Page','fr');
?>

<header class="masthead" style="background-image: url('assets/img/555176.jpg')">
    <div class="container position-relative px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
            </div>
        </div>
    </div>
</header>

<h1 class="center">Page not found</h1>
<h1 class="center"><a href="index.php">Return to home page</a></h1>

<?php
    require_once('template_foot.php');
?>