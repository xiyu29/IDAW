<?php
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

    $request = $pdo->prepare("select * from users");
    $request->execute();
    $result = $request->fetchAll();
    $length = count($result);
    $sousLength = count($result[0]) / 2;
    // print_r($length);
    // print_r($result[0]);
    // print_r($sousLength);
    // print_r($result);

    echo '<h1 align="center">Users</h1>';
    echo '<table align="center">
            <thead>
                <tr>
                    <th width="100px">id</th>
                    <th width="100px">name</th>
                    <th width="300px">email</th>
                </tr>
            </thrad>
            <tbody>';
    for($i = 0; $i < $length; $i ++){
        $sousLigne = $result[$i];
        echo '<tr align="center">';
        for($j = 0; $j < $sousLength; $j ++){
            echo "<td>$sousLigne[$j]</td>";
        }
        echo '</tr>';  
    }
    // while($row = mysqli_fetch_array($request, MYSQLI_ASSOC))
    // {
    //     echo 
    //         "<tr align='center'><td> {$row['id']}</td> ".
    //         "<td>{$row['name']} </td> ".
    //         "<td>{$row['email']} </td> ".
    //         "</tr>";
    // }
    echo '
            </tboday>
        </table>';
    
    $pdo = null;
?>