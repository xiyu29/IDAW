<?php
    require_once('template_header.php');
    // Navigation
    require_once('template_menu.php');

    $currentPageId = 'accueil';
    
    if(isset($_GET['page'])) {
        $currentPageId = $_GET['page'];
    }

    $currentPageLanguage = 'fr';
    if(isset($_GET['lang'])) {
        $currentPageLanguage = $_GET['lang'];
    }    
?>

<?php
    renderMenuToHTML('Home Page', $currentPageLanguage);
?>

<?php
    $pageToInclude = $currentPageId . "_" . $currentPageLanguage . ".php";
    if(is_readable($pageToInclude)){
        require_once($pageToInclude);
    }    
    else{
        require_once("error.php");
    }   
?>

<?php
    require_once('template_foot.php');
?>
