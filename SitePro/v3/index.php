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
    renderMenuToHTML('Home Page');
?>

<?php
    $pageToInclude = $currentPageId . ".php";
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
