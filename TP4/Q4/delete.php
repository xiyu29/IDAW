<?php

    if(isset($_POST['delete'])){
        $id_button = $_POST['idd'];
        echo $id_button;
        $sql = "DELETE FROM users WHERE id = $id_button";
        try{
            $dbco = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $dbco->exec($sql);
        }catch(PDOException $e){
            echo "Erreur : " . $e->getMessage();
        }
        header('Location:users.php');
    }

?>