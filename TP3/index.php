<?php
    if(isset($_GET['css'])){
        setcookie('style_choisi', $_GET['css']);
        $_COOKIE['style_choisi'] = $_GET['css'];
        echo '<link rel="stylesheet" href="' . $_COOKIE['style_choisi'] . '.css"/>'; 
        echo 'Cookie : ' . $_COOKIE['style_choisi']; 
    }

    if(!isset($_COOKIE['style_choisi'])){
        $_COOKIE['style_choisi'] = 'style1';
        echo '<link rel="stylesheet" href="' . $_COOKIE['style_choisi'] . '.css"/>';
        echo 'cookie auto generated';
    }

    if(isset($_POST['clearCookie'])){
        setcookie('style_choisi', '', time() - 3600);
    }  
?>

<form id="style_form" action="index.php" method="GET">
    <select name="css">
        <option value="style1">style1</option>
        <option value="style2">style2</option>
    </select>
    <input type="submit" value="Appliquer" /> 
</form>

<form method="post" action="login.php">
    <input type="submit" name="submit" value="Login">
</form>

<form method="post" action="index.php">
    <input type="submit" name="clearCookie" value="Clear cookie">
</form>

<?php

    

?>





