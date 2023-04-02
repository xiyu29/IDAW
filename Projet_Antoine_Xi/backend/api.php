<?php

    //connexion of db
    require_once('config.php');
    require_once('connexion.php');

    $request_method = $_SERVER['REQUEST_METHOD'];     
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);     
    $uri = explode( '/', $uri );     
    
    switch($request_method){

        case 'GET':

            $type = $_GET['type'];

            switch($type){
                case 'connexion':
                    $login = $_GET['login'];
                    $mdp = $_GET['mdp'];
                    $request = $pdo->prepare("SELECT Id_personne FROM personne WHERE Login='$login' AND Mdp='$mdp'");
                    $request->execute();
                    $resultat = $request->fetchAll(PDO::FETCH_OBJ);
                    break;

                case 'getName':
                    $id = $_GET['id'];
                    $request = $pdo->prepare("SELECT Prenom_personne FROM personne WHERE Id_personne='$id'");
                    $request->execute();
                    $resultat = $request->fetchAll(PDO::FETCH_OBJ);
                    break;

                case 'getMeal':
                    $id = $_GET['id'];
                    $request = $pdo->prepare("SELECT * FROM consommer WHERE Id_personne='$id' ORDER BY Date_conso DESC LIMIT 5");
                    $request->execute();
                    $resultat = $request->fetchAll(PDO::FETCH_OBJ);
                    break;

                case 'getNourriture':
                    $id_aliment = $_GET['id_aliment'];
                    $request = $pdo->prepare("SELECT nomAliment FROM aliment WHERE idAliment='$id_aliment'");
                    $request->execute();
                    $resultat = $request->fetchAll(PDO::FETCH_OBJ);
                    break;

            }
            break;

        case 'POST':
            $json = json_decode(file_get_contents('php://input'), true);
            $type = $json['type'];

            switch($type){
                case 'newUser':
                    $json = json_decode(file_get_contents('php://input'), true);         
                    $nom = $json['nom'];         
                    $prenom = $json['prenom'];
                    $login = $json['login'];         
                    $mdp = $json['mdp']; 
                    $email = $json['email'];                   
                    $request = $pdo->prepare("INSERT INTO personne (Nom_personne, Prenom_personne, Login, Mdp, Email_personne) VALUES ('$nom', '$prenom', '$login', '$mdp', '$email')");         
                    $request->execute();         
                    $resultat = $request->fetchAll(PDO::FETCH_OBJ);
                    break;  
            }
            

        case 'PUT':
            // $json = json_decode(file_get_contents('php://input'), true);
            // $id = $json['id']; 
            // $name = $json['name'];         
            // $email = $json['email'];
            // $givenName = $json['givenName'];         
            // $aimeCours = $json['aimeCours']; 
            // $dateNaissance = $json['dateNaissance'];         
            // $remarque = $json['remarque'];

            // $request = $pdo->prepare("
            //     UPDATE users 
            //     SET name='$name', email='$email',givenName='$givenName',aimeCours='$aimeCours',dateNaissance='$dateNaissance',remarque='$remarque'
            //     WHERE id='$id'
            // ");
            // $request->execute();
            break;

        case 'DELETE':
            // $json = json_decode(file_get_contents('php://input'), true);         
            // $id = $json['id'];  
            // $request = $pdo->prepare("DELETE FROM Users WHERE id=$id");
            // $request->execute();
            // $resultat = $request->fetchAll(PDO::FETCH_OBJ);
            break;
    }

    header('Content-Type: application/json');
    echo json_encode($resultat, JSON_PRETTY_PRINT);
    $pdo = null;

?>