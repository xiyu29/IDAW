<?php
    require_once('connection.php');

    function createAliment() {
        // Vérification des paramètres
        global $params;
        global $pdo;
        global $nom;
        global $type;
        $pdo = new PDO('mysql:host=localhost;dbname=projet_idaw;charset=utf8', 'root', '');
        $nom = $params['nom'];
        $type = $params['type'];
        if (empty($nom) || empty($type)) {
            header('HTTP/1.1 400 Bad Request');
            echo 'Missing parameter';
            return;
        }
        
        // Connexion à la base de données
        $pdo = new PDO('mysql:host=localhost;dbname=projet_idaw;charset=utf8', 'root', '');
        
        // Ajout de l'utilisateur à la base de données
        $stmt = $pdo->prepare('INSERT INTO aliment (nom, type) VALUES (?, ?)');
        $stmt -> execute([$nom, $type]);
        $idAliment = $pdo->lastInsertId();
        
        // Envoi de la réponse HTTP
        header('HTTP/1.1 201 Created');
        header('Location: /aliment.php/' . $idAliment);
        header('Content-Type: application/json');
        $aliment = ['idAliment' => $idAliment, 'nom' => $nom, 'type' => $type];
        $json = json_encode($aliment);
        echo $json;
    }

    function deleteAliment() {
        // Vérification des paramètres
        global $params;
        global $idAliment;
        $idAliment = $params['idAliment'];
        if (empty($idAliment)) {
            header('HTTP/1.1 400 Bad Request');
            echo 'Missing parameter';
            return;
        }
        // Suppression de l'utilisateur de la base de données
        global $pdo;
        $pdo = new PDO('mysql:host=localhost;dbname=projet_idaw;charset=utf8', 'root', '');
        $stmt = $pdo->prepare('DELETE FROM aliment WHERE idAliment = ?');
        $stmt -> execute([$idAliment]);
        
        // Envoi de la réponse HTTP
        header('HTTP/1.1 204 No Content');
    }

    function getAliment(){
        // Récupération des utilisateurs OU récupération d'un utilsiateur en particulier
        global $pdo;
        global $params;
        global $idAliment;
        $pdo = new PDO('mysql:host=localhost;dbname=projet_idaw;charset=utf8', 'root', '');

        //if idAliment in parameter of GET request
        if(($params['idAliment'] != null)){
            $request = $pdo->prepare('select * from aliment where idAliment = ?');
            $request->execute([$params['idAliment']]);
            $aliment = $request->fetchAll(PDO::FETCH_OBJ);
            
            // Conversion en JSON
            $json = json_encode($aliment);

            // HTPP response of 200 OK
            header('HTTP/1.1 200 OK');
            header('Content-Type: application/json');
            echo $json;
        }

        else {
            $request = $pdo->prepare('select * from aliment');
            $request->execute();
            $aliment = $request->fetchAll(PDO::FETCH_OBJ);
            
            // Conversion en JSON
            $json = json_encode($aliment);

            // HTPP response of 200 OK
            header('HTTP/1.1 200 OK');
            header('Content-Type: application/json');
            echo $json;
        }
    }

    function updateAliment(){
        // Vérification des paramètres
        global $params;
        global $idAliment;
        global $nom;
        global $type;
        $idAliment = $params['idAliment'];
        $nom = $params['nom'];
        $type = $params['type'];
        if (empty($idAliment) || empty($nom) || empty($type)) {
            header('HTTP/1.1 400 Bad Request');
            echo 'Missing parameter';
            return;
        }
        
        // Connexion à la base de données
        global $pdo;
        $pdo = new PDO('mysql:host=localhost;dbname=projet_idaw;charset=utf8', 'root', '');
        
        // Modification de l'utilisateur dans la base de données
        $stmt = $pdo->prepare('UPDATE aliment SET nom = ?, type = ? WHERE idAliment = ?');
        $stmt -> execute([$nom, $type, $idAliment]);
        
        // Envoi de la réponse HTTP
        header('HTTP/1.1 204 No Content');
    }
    $pdo = null;
?>