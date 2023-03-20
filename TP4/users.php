<?php

    print_r($_POST);

    //connexion of db
    require_once('Q2/connexion.php');

    //insert new record
    require_once('Q4/insert.php');

    //delete record
    require_once('Q4/delete.php');

    //modify record ok
    require_once('Q4/modify_ok.php');
    
    //install db
    // require_once('db_init.php');

    //fetch all champs in 'users'
    $request = $pdo->prepare("SELECT * FROM users ORDER BY id ASC");
    $request->execute();
    $result = $request->fetchAll(PDO::FETCH_OBJ);

    //show table
    require_once('showTable.php');

    $pdo = null;

    //modifier record
    require_once('Q4/modify.php');
?>