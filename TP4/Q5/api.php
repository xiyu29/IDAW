<?php

    //connexion of db
    require_once('../config.php');
    require_once('../Q2/connexion.php');

    $request_method = $_SERVER['REQUEST_METHOD'];     
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);     
    $uri = explode( '/', $uri );     
    
    switch($request_method){

        case 'GET':
            if(!empty($uri[4])) {             
                $request = $pdo->prepare("SELECT * FROM Users WHERE id=$uri[4]");
                $request->execute();
                $resultat = $request->fetchAll(PDO::FETCH_OBJ);
            }
            else {
                $request = $pdo->prepare("SELECT * FROM Users ORDER BY id ASC");
                $request->execute();
                $resultat = $request->fetchAll(PDO::FETCH_OBJ);
            }
            break;

        case 'POST':
            $json = json_decode(file_get_contents('php://input'), true);         
            $name = $json['name'];         
            $email = $json['email'];
            $givenName = $json['givenName'];         
            $aimeCours = $json['aimeCours']; 
            $dateNaissance = $json['dateNaissance'];         
            $remarque = $json['remarque'];          
            $request = $pdo->prepare("INSERT INTO Users (name, email, givenName, aimeCours, dateNaissance, remarque) VALUES ('$name', '$email', '$givenName', '$aimeCours', '$dateNaissance', '$remarque')");         
            $request->execute();         
            $resultat = $request->fetchAll(PDO::FETCH_OBJ);
            break;

        case 'PUT':
            $json = json_decode(file_get_contents('php://input'), true);
            $id = $json['id']; 
            $name = $json['name'];         
            $email = $json['email'];
            $givenName = $json['givenName'];         
            $aimeCours = $json['aimeCours']; 
            $dateNaissance = $json['dateNaissance'];         
            $remarque = $json['remarque']; 
            $request = $pdo->prepare("UPDATE Users SET name=$name WHERE id=$id");
            $request->execute();
            $request = $pdo->prepare("UPDATE Users SET name=$email WHERE id=$id");
            $request->execute();
            $request = $pdo->prepare("UPDATE Users SET name=$givenName WHERE id=$id");
            $request->execute();
            $request = $pdo->prepare("UPDATE Users SET name=$aimeCours WHERE id=$id");
            $request->execute();
            $request = $pdo->prepare("UPDATE Users SET name=$dateNaissance WHERE id=$id");
            $request->execute();
            $request = $pdo->prepare("UPDATE Users SET name=$remarque WHERE id=$id");
            $request->execute();
            break;

        case 'DELETE':
            $json = json_decode(file_get_contents('php://input'), true);         
            $id = $json['id'];  
            $request = $pdo->prepare("DELETE FROM Users WHERE id=$id");
            $request->execute();
            $resultat = $request->fetchAll(PDO::FETCH_OBJ);
            break;
    }

    header('Content-Type: application/json');
    echo json_encode($resultat, JSON_PRETTY_PRINT);
    $pdo = null;

    // //connexion to db
    // require_once('../config.php');
    // require_once('../Q2/connexion.php');
    // //get method http
    // $method = $_SERVER['REQUEST_METHOD'];
    // //get uri
    // $uri = $_SERVER['PATH_INFO'];
    // $uri = explode('/', $uri);
    // print_r($uri);

    // //parameter of post request
    // $params = json_decode(file_get_contents('php://input'), true);

    // //define array key id with value $id
    // $params['id'] = $uri[1];
?>