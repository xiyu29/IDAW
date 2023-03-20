<?php

    print_r($_POST);

    //connexion of db
    require_once('Q2/connexion.php');

    //insert new record
    require_once('Q4/insert.php');

    //delete record
    require_once('Q4/delete.php');

    //modify record ok
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
    
    //install db
    // require_once('db_init.php');

    //fetch all champs in 'users'
    $request = $pdo->prepare("SELECT * FROM users ORDER BY id ASC");
    $request->execute();
    $result = $request->fetchAll(PDO::FETCH_OBJ);

    //show table
    echo '<h1 align="center">Users</h1>';
    echo 
        '
           
                <table align="center" border="1px">
                    <thead>
                        <tr>
                            <th width="100px">id</th>
                            <th width="100px">name</th>
                            <th width="300px">email</th>
                            <th width="100px"></th>
                            <th width="100px"></th>
                        </tr>
                    </thrad>
                    <tbody>
        ';
    foreach($result as $value){
        $id = $value->id;
        echo
            '<tr align="center">'.
                '<td>' . $value->id . '</td>'.
                '<td>' . $value->name . '</td>'.
                '<td>' . $value->email . '</td>'.
                '
                <td>
                    <form method="post" action="users.php">
                        <input type="hidden" name="idm" value="' . $id . '">
                        <input type="submit" name="modify" value="modify"/>
                    </form>          
                </td>
                '.
                '
                <td>
                    <form method="post" action="users.php">
                        <input type="hidden" name="idd" value="' . $id . '">
                        <input type="submit" name="delete" value="delete"/>
                    </form>
                </td>
                '.
            '</tr>'
        ;
    }

    echo 
        '
                </tboday>
            </table>
        ';

    echo
        '
                <table align="center">
                    <form method="post" action="users.php">
                        <tr>
                            <td>
                                New name: <input type="text" placeholder="new name" name="newName" id="newName">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                New email: <input type="text" placeholder="new email" name="newEmail" id="newEmail">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="submit" name="add" value="add"/>
                            </td>
                        </tr>
                    </form>
                </table>
        ';

    $pdo = null;

    //modifier record
    require_once('Q4/modify.php');
?>