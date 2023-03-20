<?php

    //connexion of db
    require_once('config.php');

    $connectionString = "mysql:host=". _MYSQL_HOST;

    if(defined('_MYSQL_PORT')){
        $connectionString .= ";port=". _MYSQL_PORT;
    }
    
    $connectionString .= ";dbname=" . _MYSQL_DBNAME;
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' );

    try {
        $pdo = new PDO($connectionString,_MYSQL_USER,_MYSQL_PASSWORD,$options);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $erreur) {
        echo 'Erreur : '.$erreur->getMessage();
    }

    //fetch all champs in 'users'
    $request = $pdo->prepare("select * from users");
    $request->execute();
    $result = $request->fetchAll(PDO::FETCH_OBJ);

    echo '<h1 align="center">Users</h1>';
    echo 
        '
            <table align="center">
                <thead>
                    <tr>
                        <th width="100px">id</th>
                        <th width="100px">name</th>
                        <th width="300px">email</th>
                    </tr>
                </thrad>
                <tbody>
        ';
    foreach($result as $value){
        echo
            '<tr align="center">'.
                '<td>' . $value->id . '</td>'.
                '<td>' . $value->name . '</td>'.
                '<td>' . $value->email . '</td>'.
            '</tr>'
        ;
    }
    echo 
        '
                </tboday>
            </table>
        ';
    
    $pdo = null;

    // require_once('db_init.php');
?>