<?php

// connect to db
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dbtest";
    $conn = new mysqli($servername, $username, $password, $dbname);

// check if the connexion is succeed
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    else{
        echo 'connexion ok';
        echo '<br>';
    }  

?>