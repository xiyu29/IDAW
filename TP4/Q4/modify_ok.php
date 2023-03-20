<?php
    if(isset($_POST['modify_ok'])){
        $newName = $_POST['modifyName'];
        $newEmail = $_POST['modifyEmail'];
        $id = $_POST['idmok'];
        $sql = "UPDATE users SET name = '" . $newName . "' , email = '" . $newEmail . "' WHERE id = $id";
        print_r($sql);
        try{
            $dbco = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $dbco->exec($sql);
        }catch(PDOException $e){
            echo "Erreur : " . $e->getMessage();
        }
        // header('Location:users.php');
    }

?>