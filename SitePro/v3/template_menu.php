<!-- <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
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
                <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="info-technique.php">Info</a></li>
            </ul>
        </div>
    </div>
</nav> -->

<?php
    function renderMenuToHTML($currentPageId, $currentPageLanguage) {
        $mymenu = array(
            'Home Page' => array( 'index' ),
            'CV' => array( 'cv' ),
            'Projets' => array('projets'),
            'Contact' => array('contact'),
            'Info' => array('info-technique'),
        );
        echo '
            <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
                <div class="container px-4 px-lg-5">
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                            Menu
                            <i class="fas fa-bars"></i>
                        </button>
                    <div class="collapse navbar-collapse" id="navbarResponsive">
                        <ul class="navbar-nav ms-auto py-4 py-lg-0">
        ';

        foreach($mymenu as $pageId => $pageParameters) {
            if($pageId == 'Home Page'){
                echo '<li class="nav-item"><a id="' . 
                    $pageId . 
                    '" class="nav-link px-lg-3 py-3 py-lg-4" href="' . 
                    $pageParameters[0] . '.php?page=accueil&lang=' . 
                    $currentPageLanguage . '">' . $pageId . '</a></li>';
            }
            else{
                echo '<li class="nav-item"><a id="' . $pageId . '" class="nav-link px-lg-3 py-3 py-lg-4" href="index.php?page=' . $pageParameters[0] . '&lang=' . $currentPageLanguage . '">' . $pageId . '</a></li>';
            }
        }
        
        if($currentPageLanguage == "fr"){
            $currentPageLanguage = "en";
        }
        else{
            $currentPageLanguage = "fr";
        }
        echo '<li class="nav-item"><a id="lang" class="nav-link px-lg-3 py-3 py-lg-4" href="index.php?page=accueil&lang=' . $currentPageLanguage . '">' . $currentPageLanguage. '</a></li>';
        echo '
                        </ul>
                    </div>
                </div>
            </nav>   
        ';
    }
?>
