<?php

    require_once('config.php');
    $servername = _MYSQL_HOST; $dbname = _MYSQL_DBNAME; $username = _MYSQL_USER; $password = _MYSQL_PASSWORD;

    //drop a table from db
    try{
        $dbco = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "DROP TABLE users";
        $dbco->exec($sql);
        
        echo 'Table bien supprimée';
        echo '<br>';
    }catch(PDOException $e){
        echo "Erreur : " . $e->getMessage();
    }

    //create a new table in db       
    try{
        $dbco = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "CREATE TABLE users(
                id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(30), 
                email VARCHAR(30) 
                )";
        
        $dbco->exec($sql);
        echo 'Table bien créée !';
        echo '<br>';
    }catch(PDOException $e){
        echo "Erreur : " . $e->getMessage();
    }

    //insert data
    try{
        $dbco = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql0 = "INSERT INTO users(name, email)
                VALUES('titi','titi@gmail.com')";
        $sql1 = "INSERT INTO users(name, email)
                VALUES('tata','tata@gmail.com')";
        $sql2 = "INSERT INTO users(name, email)
                VALUES('toto','toto@gmail.com')";
        $sql3 = "INSERT INTO users(name, email)
                VALUES('imtne','imtne@imt-nord-europe.fr')";


        $dbco->exec($sql0);
        $dbco->exec($sql1);
        $dbco->exec($sql2);
        $dbco->exec($sql3);
        
        echo 'Entrée ajoutée dans la table';
        echo '<br>';
    }catch(PDOException $e){
      echo "Erreur : " . $e->getMessage();
    }
?>