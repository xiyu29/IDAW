<?php

    if(isset($_POST['modify'])){
        $id_button = $_POST['idm'];

        $pdo = new PDO($connectionString,_MYSQL_USER,_MYSQL_PASSWORD,$options);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM users WHERE id=" . $id_button;

        $request = $pdo->prepare($sql);
        $request->execute();
        $result = $request->fetchAll(PDO::FETCH_OBJ);

        echo '
            <form method="post" action="users.php">
                <table align="center">
                    <tr>
            ';
        foreach($result as $value){
            echo
                '<td><input type="text" value="' . $value->name . '" name="modifyName" id="modifyName"></td>'.
                '<td><input type="text" value="' . $value->email . '" name="modifyEmail" id="modifyEmail"></td>';
        }
        echo '
                        <td>
                            <input type="hidden" name="idmok" value="' . $id_button . '">
                            <input type="submit" name="modify_ok" value="modify"/>
                        </td>
                    </tr>
                </table>            
            </form>
        ';  
    }

?>