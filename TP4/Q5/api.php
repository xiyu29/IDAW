<?php

    //connexion of db
    require_once('../config.php');
    require_once('../Q2/connexion.php');

    $request_method = $_SERVER['REQUEST_METHOD'];     
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);     
    $uri = explode( '/', $uri );     
    $resultat=NULL; 
    echo $request_method;
    
    switch($request_method){
        case 'GET':
            if(!empty($uri[4])) {             
                $request = $pdo->prepare("SELECT * FROM Users WHERE id=$uri[4]");
                $request->execute();
                $resultat = $request->fetchAll(PDO::FETCH_OBJ);
            }
            else {
                $request = $pdo->prepare("SELECT * FROM Users");
                $request->execute();
                $resultat = $request->fetchAll(PDO::FETCH_OBJ);
            }
            break;

        case 'POST':
            $json = json_decode(file_get_contents('php://input'), true);         
            $name = $json['name'];         
            $email = $json['email'];         
            $request = $pdo->prepare("INSERT INTO Users (name, email) VALUES ('$name', '$email')");         
            $request->execute();         
            $resultat = $request->fetchAll(PDO::FETCH_OBJ);
            break;

        case 'PUT':
            if(!empty($uri[4])) {
                $json = json_decode(file_get_contents('php://input'), true);
                $name = $json['name'];
                $email = $json['email'];
                $request = $pdo->prepare("UPDATE Users SET email='" . $email . "' WHERE id=" . $uri[4]);
                $request->execute();
                $request = $pdo->prepare("UPDATE Users SET name='" . $name . "' WHERE id=" . $uri[4]);
                $request->execute();
            }
            break;

        case 'DELETE':
            if(!empty($uri[4])) {
                $request = $pdo->prepare("DELETE FROM Users WHERE id=$uri[4])");
            }
            break;
    }

    header('Content-Type: application/json');
    echo json_encode($resultat, JSON_PRETTY_PRINT);
    $pdo = null;
?>