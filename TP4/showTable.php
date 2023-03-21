<?php

    echo '<h1 align="center">Users</h1>';
    echo 
        '
           
                <table align="center">
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

?>