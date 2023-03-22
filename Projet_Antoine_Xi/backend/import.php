<?php

    define('_MYSQL_HOST','127.0.0.1');
    define('_MYSQL_PORT',3306);
    define('_MYSQL_DBNAME','projet_idaw');
    define('_MYSQL_USER','root');
    define('_MYSQL_PASSWORD','');

?>

<?php

    $servername = _MYSQL_HOST; $dbname = _MYSQL_DBNAME; $username = _MYSQL_USER; $password = _MYSQL_PASSWORD;

    $connectionString = "mysql:host=". _MYSQL_HOST;

    if(defined('_MYSQL_PORT')){
        $connectionString .= ";port=". _MYSQL_PORT;
    }

    $connectionString .= ";dbname=" . _MYSQL_DBNAME;
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' );

    try {
        $pdo = new PDO($connectionString,_MYSQL_USER,_MYSQL_PASSWORD,$options);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo 'connexion ok';
    }
    catch (PDOException $erreur) {
        echo 'Erreur : '.$erreur->getMessage();
    }

?>

<!-- here db connected  -->

<?php

    // $file = fopen('Personnes.csv', 'r');
    // while (($line = fgets($file)) !== false) {
    //     $data = explode(',', $line);
    //     $sql = "INSERT INTO personne(Nom_personne, Prenom_personne, Email_personne) VALUES ('$data[1]', '$data[2]', '$data[0]')";
    //     try{
    //         $dbco = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    //         $dbco->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
    //         $dbco->exec($sql);
    //     }catch(PDOException $e){
    //         echo "Erreur : " . $e->getMessage();
    //     }
    // }
    // fclose($file);

    $file = fopen('Personnes.csv', 'r');

    $data = array();
    while (($row = fgetcsv($file)) !== false) {
        $data[] = $row;
    }

    fclose($file);

    print_r($data);

?>