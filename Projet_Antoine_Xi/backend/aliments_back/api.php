<?php
    require_once('connection.php');
    require_once('aliment.php');

    // Récupération de la méthode HTTP
    $method = $_SERVER['REQUEST_METHOD'];

    // Récupération de l'URI
    $uri = $_SERVER['PATH_INFO']; 
    //print_r($uri);
    $uri = explode('/', $uri);
    // print_r($uri[1]);

    // Parameter of POST request
    $params = json_decode(file_get_contents('php://input'), true);
    //show the array
    print_r($params);

    //Define array key id with value $id
    $params['idAliment'] = $uri[1];    

    // Exécution de la méthode HTTP
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        getAliment( $params['idAliment']);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        createAliment( $params['nomAliment'], $params['type']);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
        updateAliment( $params['idAliment'], $params['nomAliment'], $params['type']);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
        deleteAliment( $params['idAliment']);
    }    

?>