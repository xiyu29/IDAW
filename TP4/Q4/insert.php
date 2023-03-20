<?php

    if(isset($_POST['add'])){
        if (isset($_POST['newName']) && isset($_POST['newEmail'])) {
            $newName = $_POST['newName'];
            $newEmail = $_POST['newEmail'];

            echo $newName;
            echo $newEmail;
            
            $sql = "INSERT INTO users (`name`, `email`) VALUES ('$newName', '$newEmail')";

            //insert a new record

            try{
                $dbco = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $dbco->exec($sql);
            }catch(PDOException $e){
                echo "Erreur : " . $e->getMessage();
            }
        }
        else{
            echo 'one or more values losing';
        }
        
        header('Location:users.php');
    }

?>