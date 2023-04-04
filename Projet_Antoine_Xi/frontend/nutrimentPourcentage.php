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
            <canvas id="myChart"></canvas>
            <hr class="my-4" />
            <!-- Pager-->
            <!-- <div class="d-flex justify-content-end mb-4"><a class="btn btn-primary text-uppercase" href="post.html">Plus repas →</a></div> -->
        </div>
    </div>
</div>

<?php

    require_once('template_foot.php');

?>

<script>
    showPourcentage(666);
</script>

